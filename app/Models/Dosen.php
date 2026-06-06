<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'nama',
        'nip',
        'email'
    ];

    public $timestamps = false; // jika tabel tidak memiliki created_at dan updated_at
}