<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nama',
        'nim',
        'email'
    ];

    public $timestamps = false; // jika tabel tidak memiliki created_at dan updated_at
}