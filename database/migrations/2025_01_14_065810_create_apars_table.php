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
        Schema::create('apars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_apar', 10)->unique();
            $table->index('kode_apar');
            $table->string('no_apar', 10);
            $table->string('dept', 50);
            $table->string('lokasi', 50);
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->string('berat', 50);
            $table->string('merk', 50);
            $table->string('type', 50);
            $table->date('tgl_pembelian');
            $table->date('last_refill');
            $table->date('next_refill');
            $table->string('standar_pengisian', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
