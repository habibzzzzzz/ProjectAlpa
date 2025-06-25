<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pemesanan', function (Blueprint $table) {
        $table->string('wilayah')->nullable();
        $table->unsignedBigInteger('kurir_id')->nullable();
    });
}

public function down()
{
    Schema::table('pemesanan', function (Blueprint $table) {
        $table->dropColumn(['wilayah', 'kurir_id']);
    });
}

};
