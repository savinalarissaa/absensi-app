<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kehadiran', function (Blueprint $table) {

            $table->id('id_kehadiran');

            $table->unsignedBigInteger('id_mahasiswa');

            $table->unsignedBigInteger('id_kelas');

            $table->dateTime('waktu_absen');

            $table->string('foto_url', 500)
                ->nullable();

            $table->enum('status', [
                'Hadir',
                'Izin',
                'Sakit',
                'Alpha'
            ])->default('Hadir');

            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')
                ->on('mahasiswa');

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('kelas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};