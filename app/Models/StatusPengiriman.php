<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengiriman extends Model
{
    use HasFactory;

    protected $table = 'status_pengiriman';
    
    protected $fillable = [
        'pemesanan_id',
        'status',
        'keterangan',
        'updated_by'
    ];

    // Relasi ke pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    // Status yang tersedia
    public static $STATUS = [
        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
        'dikonfirmasi' => 'Pesanan Dikonfirmasi',
        'dalam_penjemputan' => 'Dalam Proses Penjemputan',
        'dijemput' => 'Barang Telah Dijemput',
        'dalam_pengiriman' => 'Dalam Proses Pengiriman',
        'diterima' => 'Barang Telah Diterima',
        'gagal' => 'Pengiriman Gagal'
    ];
}
