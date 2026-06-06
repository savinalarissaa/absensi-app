<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // READ ALL
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        // return view('mahasiswa.mahasiswa', compact('mahasiswa'));
        return view('admin.admin', compact('mahasiswa'));
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