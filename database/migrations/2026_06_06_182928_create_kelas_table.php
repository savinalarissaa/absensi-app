<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {

            $table->id('id_kelas');

            $table->unsignedBigInteger('id_matkul');
            $table->unsignedBigInteger('id_dosen');

            $table->date('tanggal_kelas');

            $table->time('jam_mulai')
                ->nullable();

            $table->time('jam_selesai')
                ->nullable();

            $table->string('topik', 255);

            $table->foreign('id_matkul')
                ->references('id_matkul')
                ->on('mata_kuliah');

            $table->foreign('id_dosen')
                ->references('id_dosen')
                ->on('dosen');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};