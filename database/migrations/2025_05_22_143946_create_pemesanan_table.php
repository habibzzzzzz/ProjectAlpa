<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_pengirim');
            $table->string('nama_penerima');
            $table->string('alamat_tujuan');
            $table->string('layanan');
            $table->string('harga');
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran')->default('menunggu');
            $table->string('bukti_transfer')->nullable();
            $table->string('status_pengiriman')->default('menunggu konfirmasi');
            $table->timestamps();

            // 🔽 (Optional tapi direkomendasikan) Foreign key
            // $table->foreign('kurir_id')->references('id')->on('kurirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
