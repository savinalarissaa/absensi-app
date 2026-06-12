<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\MataKuliah;


use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $id = session('dosen_id');
        // $dosen = Dosen::findOrFail($id);    
        $mahasiswa = Mahasiswa::all();
        $matakuliah = MataKuliah::all();
        $dosen = Dosen::all();

        $kelas = Kelas::with([
            'mataKuliah',
            'dosen'
        ])->get();

        return view('Dosen.dosen', compact(
            'dosen',
            'mahasiswa',
            'kelas', 
            'matakuliah'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        Dosen::create([
            'nama'  => $request->nama,
            'nip'   => $request->nip,
            'email' => $request->email
        ]);

        // return redirect('/admin');
        return redirect('/login');
    }

    public function beri_notifikasi(Request $apiGatewayUrl){
        Http::post(
            $apiGatewayUrl,
            [
                'subject' => 'Absensi Mahasiswa',
                'message' => 'Mahasiswa Budi berhasil melakukan absensi'
            ]
        );
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
        $dosen = Dosen::findOrFail($id);

        $dosen->delete();

        return redirect('/admin');

    }
}
