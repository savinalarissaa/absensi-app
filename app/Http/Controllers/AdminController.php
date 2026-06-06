<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Kehadiran;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // READ ALL
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        $matakuliah = MataKuliah::all();
        $kelas = Kelas::with(['dosen', 'mataKuliah'])->get();
        $kehadiran = Kehadiran::all();

        return view('admin.admin', compact('mahasiswa', 'dosen', 'matakuliah', 'kelas'));
    }

    // CREATE
    public function store(Request $request)
    {
        Mahasiswa::create([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'email' => $request->email
        ]);

        return redirect('/admin');
    }

    // READ ONE
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'email' => $request->email
        ]);

        return redirect('/admin');
    }

    // DELETE
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->delete();

        return redirect('/admin');
    }
}