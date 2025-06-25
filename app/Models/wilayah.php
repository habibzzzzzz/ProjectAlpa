<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah'; // pastikan nama tabel benar

    protected $fillable = [
        'nama_wilayah',
        'kurir_id',
    ];

    // OPTIONAL: relasi ke model Kurir (kalau kamu punya model Kurir)
    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }
}
