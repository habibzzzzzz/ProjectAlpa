<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class KurirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role !== 'kurir') {
            return redirect()->route('dashboard');
        }
        // Ambil semua pesanan beserta status pengiriman terbaru
        $data = DB::table('pemesanan')
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
        return view('kurir.dashboard', compact('data'));
    }
}