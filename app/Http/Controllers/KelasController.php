<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        $matkul = MataKuliah::all();
        $kelas = Kelas::with(['dosen', 'mataKuliah'])->get();

        return view('admin', compact(
            'mahasiswa',
            'dosen',
            'matkul',
            'kelas'
        ));    
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     Kelas::create([
    //     'id_matkul' => $request->id_matkul,
    //     'id_dosen' => $request->id_dosen,
    //     'tanggal_kelas' => $request->tanggal_kelas,
    //     'jam_mulai' => $request->jam_mulai,
    //     'jam_selesai' => $request->jam_selesai,
    //     'topik' => $request->topik,
    //     ]);

    //     // tambah fungsi kirim notifikasi sns

    //     return redirect('/dosen');
    // }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul', 'id_matkul');
    }

    
    
    // yang baru, belum dicoba
    public function store(Request $request)
    {
        $kelas = Kelas::create([
            'id_matkul' => $request->id_matkul,
            'id_dosen' => $request->id_dosen,
            'tanggal_kelas' => $request->tanggal_kelas,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'topik' => $request->topik,
        ]);

        // Kirim notifikasi ke Lambda -> SNS -> SQS
        // Http::post(env('LAMBDA_API_URL'), [
        //     'subject' => 'Absensi kelas baru dibuat',
        //     'message' => [
        //         'id_kelas' => $kelas->id,
        //         'id_matkul' => $kelas->id_matkul,
        //         'nama_matakuliah' => $kelas->mataKuliah->nama_matkul, // ??
        //         'id_dosen' => $kelas->id_dosen,
        //         'nama_dosen' => $kelas->dosen->nama, // ???
        //         'tanggal_kelas' => $kelas->tanggal_kelas,
        //         'jam_mulai' => $kelas->jam_mulai,
        //         'jam_selesai' => $kelas->jam_selesai,
        //         'topik' => $kelas->topik,
        //     ]
        // ]);

        
        // coba yang diatas dulu, baru ini di-uncomment
        $kelas->load('mataKuliah');

        $pesan = "Presensi baru telah dibuat!\n\n";
        $pesan .= "Mata Kuliah: {$kelas->mataKuliah->nama_matkul}\n";
        $pesan .= "Topik: {$kelas->topik}\n";
        $pesan .= "Tanggal: {$kelas->tanggal_kelas}\n";
        $pesan .= "Jam: {$kelas->jam_mulai} - {$kelas->jam_selesai}";

        Http::post(env('LAMBDA_API_URL'), [
            'subject' => 'Presensi Baru',
            'message' => $pesan
        ]);

        return redirect('/dosen');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect('/admin');

    }
}
