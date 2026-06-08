<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Kehadiran;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        $matakuliah = MataKuliah::all();
        $kelas = Kelas::with(['dosen', 'mataKuliah'])->get();

        $kehadiran = Kehadiran::with([
            'mahasiswa',
            'kelas.dosen',
            'kelas.mataKuliah'
        ])->get();

        return view('kehadiran.kehadiran', compact('kehadiran', 'mahasiswa', 'dosen', 'matakuliah', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    if ($request->status == 'Hadir') {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('foto')->store(
            'presensi',
            'public'
        );
    }    
    
    Kehadiran::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_kelas' => $request->id_kelas,
            'status' => $request->status,
            'waktu_absen' => now(),
            'foto' => $path ?? null,
        ]);

        return redirect('/mahasiswa');
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
        //
    }
}
