<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';
    protected $primaryKey = 'id_kehadiran';

    protected $fillable = [
        'id_mahasiswa',
        'id_kelas',
        'waktu_absen',
        'status'
    ];

    // belum ada foto absen

    public function mahasiswa()
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'id_mahasiswa',
            'id_mahasiswa'
        );
    }

    public function kelas()
    {
        return $this->belongsTo(
            Kelas::class,
            'id_kelas',
            'id_kelas'
        );
    }
    public $timestamps = false;
}
