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
        // Schema::create('kehadiran', function (Blueprint $table) {
        //     $table->id('id_kehadiran');

        //     $table->unsignedBigInteger('id_mahasiswa');
        //     $table->unsignedBigInteger('id_kelas');

        //     $table->dateTime('waktu_absen');

        //     $table->decimal('latitude', 10, 8)->nullable();
        //     $table->decimal('longitude', 11, 8)->nullable();

        //     $table->string('foto_url', 500)->nullable();

        //     $table->enum('status', [
        //         'Hadir',
        //         'Izin',
        //         'Sakit',
        //         'Alpha'
        //     ])->default('Hadir');

        //     $table->foreign('id_mahasiswa')
        //         ->references('id_mahasiswa')
        //         ->on('mahasiswa')
        //         ->onDelete('cascade');

        //     $table->foreign('id_kelas')
        //         ->references('id_kelas')
        //         ->on('kelas')
        //         ->onDelete('cascade');

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
