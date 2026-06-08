<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LambdaController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        $file = $request->file('file');

        $response = Http::post(
            'https://u5cfo8e1xd.execute-api.us-east-1.amazonaws.com/prod/upload',
            [
                'filename' => $file->getClientOriginalName(),
                'file' => base64_encode(
                    file_get_contents($file->getRealPath())
                )
            ]
        );

        return back()->with(
            'success',
            'Upload berhasil'
        );
    }
}