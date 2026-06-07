<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Kehadiran;
use App\Models\MataKuliah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // READ ALL
    public function index()
    {
        $kelas = Kelas::all();

        $mahasiswa = Mahasiswa::where(
            'email',
            Auth::user()->email
        )->first();
        if (!$mahasiswa) {
            abort(403, 'Data mahasiswa tidak ditemukan');
        }

        // Presensi milik mahasiswa yang login
        $kehadiran = Kehadiran::with([
            'mahasiswa',
            'kelas.dosen',
            'kelas.mataKuliah'
        ])
        ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
        ->get();

        // Ambil id kelas yang sudah dipresensi
        $kelasSudahPresensi = Kehadiran::where(
            'id_mahasiswa',
            $mahasiswa->id_mahasiswa
        )->pluck('id_kelas');

        $kelasBelumPresensi = Kelas::with([
            'dosen',
            'mataKuliah'
        ])
        ->whereNotIn('id_kelas', $kelasSudahPresensi)
        ->get();

        return view('mahasiswa.mahasiswa', compact(
            'mahasiswa',
            'kehadiran',
            'kelasBelumPresensi',
            'kelasSudahPresensi',
            'kelas'
        ));
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