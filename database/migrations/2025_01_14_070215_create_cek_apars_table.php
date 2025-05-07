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
        Schema::create('cek_apars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_apar', 10);
            $table->foreign('kode_apar')
                ->references('kode_apar')
                ->on('apars')
                ->onDelete('cascade');
            $table->date('tgl');
            $table->boolean('jarum_tekanan');
            $table->boolean('segel');
            $table->boolean('handgrip');
            $table->boolean('tabung');
            $table->boolean('selang');
            $table->boolean('nozzle');
            $table->boolean('karung_gone');
            $table->boolean('air_drum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_apars');
    }
};
