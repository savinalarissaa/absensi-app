<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {

            $table->id('id_mahasiswa');

            $table->string('nama', 100);

            $table->string('nim', 30)
                ->unique();

            $table->string('email', 100)
                ->nullable();

            $table->timestamp('created_at')
                ->useCurrent();

            $table->enum('user_type', ['mahasiswa'])
                ->default('mahasiswa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};