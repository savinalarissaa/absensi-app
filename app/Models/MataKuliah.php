<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_matkul';

    protected $fillable = [
        'nama_matkul',
        'kode_matkul'
    ];

    public $timestamps = false;
}