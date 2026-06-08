<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Kehadiran;

class LambdaController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:10240'
        ]);

        $file = $request->file('foto');

        $filename = time() . '_' . $file->getClientOriginalName();

        $response = Http::post(
            'https://u5cfo8e1xd.execute-api.us-east-1.amazonaws.com/prod/upload',
            [
                'filename' => $filename,
                'file' => base64_encode(
                    file_get_contents($file->getRealPath())
                )
            ]
        );

        if (!$response->successful()) {
            return back()->with(
                redirect('/home')
            );
        }

        $result = $response->json();

        // Jika Lambda mengembalikan body JSON
        if (isset($result['body'])) {
            $result = json_decode($result['body'], true);
        }

        $s3File = $result['filename'] ?? $filename;
        $s3Url = "https://projek-absen.s3.us-east-1.amazonaws.com/" . $s3File;

        Kehadiran::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_kelas' => $request->id_kelas,
            'status' => $request->status,
            'waktu_absen' => now(),
            'foto_url' => $s3Url,
        ]);

        return redirect('/mahasiswa')
            ->with('success', 'Presensi berhasil disimpan');
    }
}
