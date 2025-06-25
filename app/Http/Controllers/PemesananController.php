<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPengiriman; // model yang nyambung ke tabel status_pengiriman
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PemesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function history()
    {
        try {
            Log::info('Mengambil riwayat pemesanan untuk user: ' . Auth::id());

            $data = DB::table('pemesanan')
                ->where('pemesanan.user_id', Auth::id())
                ->leftJoin('status_pengiriman', function($join) {
                    $join->on('pemesanan.id', '=', 'status_pengiriman.pemesanan_id')
                        ->whereRaw('status_pengiriman.id = (
                            SELECT MAX(id) FROM status_pengiriman sp2 
                            WHERE sp2.pemesanan_id = pemesanan.id
                        )');
                })
                ->select(
                    'pemesanan.*',
                    'status_pengiriman.status as status_pengiriman'
                )
                ->orderBy('pemesanan.created_at', 'desc')
                ->get();

            Log::info('Berhasil mengambil riwayat pemesanan', ['count' => $data->count()]);

            if (request()->ajax()) {
                return response()->json($data);
            }

            return view('customer.history', compact('data'));
        } catch (\Exception $e) {
            Log::error('Error dalam mengambil riwayat pemesanan', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengambil riwayat pemesanan',
                    'error' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }

            return back()->with('error', 'Gagal mengambil riwayat pemesanan');
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('Memulai proses pemesanan', ['request' => $request->all()]);

            // Cek apakah user sudah login
            if (!Auth::check()) {
                Log::warning('User tidak terautentikasi');
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Unauthorized',
                        'redirect' => route('login')
                    ], 401);
                }
                return redirect()->route('login');
            }

            // Validasi
            $rules = [
                'nama_pengirim' => 'required|string',
                'nama_penerima' => 'required|string',
                'alamat_tujuan' => 'required|string',
                'layanan' => 'required|string',
                'harga' => 'required',
                'metode_pembayaran' => 'required|string',
            ];

            // Jika metode transfer, wajib upload bukti_transfer
            if ($request->metode_pembayaran === 'transfer') {
                $rules['bukti_transfer'] = 'required|image|mimes:jpg,jpeg,png|max:2048';
            }

            Log::info('Memvalidasi input');
            $validated = $request->validate($rules);
            Log::info('Validasi berhasil', ['validated' => $validated]);

            // Simpan file jika ada
            $buktiTransferPath = null;
            if ($request->hasFile('bukti_transfer')) {
                Log::info('Menyimpan bukti transfer');
                $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
                Log::info('Bukti transfer tersimpan', ['path' => $buktiTransferPath]);
            }

            // Bersihkan format harga
            $harga = str_replace(['Rp', '.', ','], '', $request->harga);
            Log::info('Harga setelah dibersihkan', ['harga' => $harga]);

            DB::beginTransaction();

            // Simpan pemesanan
            $pemesanan_id = DB::table('pemesanan')->insertGetId([
                'user_id' => Auth::id(),
                'nama_pengirim' => $request->nama_pengirim,
                'nama_penerima' => $request->nama_penerima,
                'alamat_tujuan' => $request->alamat_tujuan,
                'layanan' => $request->layanan,
                'harga' => $harga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => ($request->metode_pembayaran === 'transfer' && $buktiTransferPath) ? 'selesai' : ($request->metode_pembayaran === 'transfer' ? 'menunggu transfer' : 'selesai'),
                'bukti_transfer' => $buktiTransferPath ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Buat status pengiriman awal
            $this->createInitialStatus($pemesanan_id);

            DB::commit();

            // Ambil data pemesanan terbaru
            $latestOrders = $this->getUserOrders();
            Log::info('Berhasil mengambil data pesanan terbaru', ['count' => count($latestOrders)]);

            $message = ($request->metode_pembayaran === 'transfer' && $buktiTransferPath) 
                ? 'Bukti transfer berhasil diupload! Pembayaran selesai dan pemesanan berhasil dikirim!'
                : ($request->metode_pembayaran === 'transfer' 
                    ? 'Pemesanan berhasil dikirim! Silakan upload bukti transfer untuk menyelesaikan pembayaran.'
                    : 'Pemesanan berhasil dikirim!');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'orders' => $latestOrders
                ], 200);
            }

            return redirect()->back()->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validasi gagal', ['errors' => $e->errors()]);
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data yang dimasukkan tidak valid',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error dalam proses pemesanan', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan pesanan. Silakan coba lagi.',
                    'error' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }

            return redirect()->back()
                ->withErrors(['error' => 'Gagal menyimpan pesanan. Silakan coba lagi.'])
                ->withInput();
        }
    }

    private function getUserOrders()
    {
        return DB::table('pemesanan')
            ->where('pemesanan.user_id', Auth::id())
            ->leftJoin('status_pengiriman', function($join) {
                $join->on('pemesanan.id', '=', 'status_pengiriman.pemesanan_id')
                    ->whereRaw('status_pengiriman.id = (
                        SELECT MAX(id) FROM status_pengiriman sp2 
                        WHERE sp2.pemesanan_id = pemesanan.id
                    )');
            })
            ->select(
                'pemesanan.*',
                'status_pengiriman.status as status_pengiriman'
            )
            ->orderBy('pemesanan.created_at', 'desc')
            ->get();
    }

    // Tambahkan method untuk membuat status pengiriman awal
    private function createInitialStatus($pemesanan_id)
    {
        return DB::table('status_pengiriman')->insert([
            'pemesanan_id' => $pemesanan_id,
            'status' => 'menunggu_konfirmasi',
            'keterangan' => 'Pesanan baru dibuat',
            'updated_by' => 'system',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}