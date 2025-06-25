<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPengiriman;

class StatusPengirimanController extends Controller
{
    
    public function index()
    {
        $data_status = StatusPengiriman::with('pemesanan')->get();
        return view('admin.dashboard', compact('data_status'));
   
    }

    public function update(Request $request, $pemesanan_id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(\App\Models\StatusPengiriman::$STATUS))
        ]);

        // Ambil status_pengiriman terbaru untuk pemesanan ini
        $pengiriman = \App\Models\StatusPengiriman::where('pemesanan_id', $pemesanan_id)
            ->orderByDesc('id')
            ->firstOrFail();
        $pengiriman->status = $request->status;
        $pengiriman->save();

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui!');
    }
   
}

