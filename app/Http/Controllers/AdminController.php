<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPengiriman;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                return redirect('/dashboard')->with('error', 'Unauthorized access.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Data untuk status pengiriman (semua pesanan dengan status terbaru)
        $pemesanan = DB::table('pemesanan')
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

        // Data untuk riwayat pesanan (pesanan dengan status diterima)
        $riwayatPesanan = DB::table('pemesanan')
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
            ->where('status_pengiriman.status', 'diterima')
            ->orderBy('pemesanan.created_at', 'desc')
            ->get();

        // Data untuk daftar pengguna
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('pemesanan', 'riwayatPesanan', 'users'));
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Data user berhasil diperbarui!');
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function exportLaporan(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Query untuk riwayat pesanan dengan filter tanggal
        $riwayatPesanan = DB::table('pemesanan')
            ->leftJoin('status_pengiriman', function($join) {
                $join->on('pemesanan.id', '=', 'status_pengiriman.pemesanan_id')
                    ->whereRaw('status_pengiriman.id = (
                        SELECT MAX(id) FROM status_pengiriman sp2 
                        WHERE sp2.pemesanan_id = pemesanan.id
                    )');
            })
            ->select(
                'pemesanan.*',
                'status_pengiriman.status as status_pengiriman',
                'status_pengiriman.updated_at as tanggal_selesai'
            )
            ->where('status_pengiriman.status', 'diterima')
            ->whereBetween('status_pengiriman.updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('status_pengiriman.updated_at', 'desc')
            ->get();

        // Hitung total pendapatan
        $totalPendapatan = $riwayatPesanan->sum('harga');
        $totalPesanan = $riwayatPesanan->count();

        // Generate PDF
        $pdf = PDF::loadView('admin.laporan-pdf', compact('riwayatPesanan', 'totalPendapatan', 'totalPesanan', 'startDate', 'endDate'));
        
        return $pdf->download('laporan-riwayat-pemesanan-' . $startDate . '-sampai-' . $endDate . '.pdf');
    }
}