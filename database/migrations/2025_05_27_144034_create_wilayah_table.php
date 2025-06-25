<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah')->unique(); // Contoh: Plaju, Kertapati
            $table->unsignedBigInteger('kurir_id');   // foreign key ke user (kurir)
            $table->timestamps();

            $table->foreign('kurir_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};

