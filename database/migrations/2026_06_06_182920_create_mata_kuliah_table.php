<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {

            $table->id('id_matkul');

            $table->string('nama_matkul', 100);

            $table->string('kode_matkul', 20)
                ->unique()
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};