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
        Schema::create('cek_rumah_apars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumah_apar_id')->references('id')->on('rumah_apars')->onDelete('cascade');
            $table->boolean('drum');
            $table->boolean('gone');
            $table->boolean('kerusakan_box');
            $table->boolean('kebersihan_box');
            $table->boolean('gembok');
            $table->boolean('kebersihan_drum');
            $table->string('judge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_rumah_apars');
    }
};
