<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;

class AuthManager extends Controller
{
    function login() {
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->user_type == 'dosen') {
                return redirect('/dosen');
            }

            if ($user->user_type == 'mahasiswa') {
                return redirect('/mahasiswa');
            }

            if ($user->user_type == 'admin') {
                return redirect('/admin');
            }

            return redirect('/home');
        }

        return redirect(route('login'))
            ->with("error", "Email or password are invalid");
    }

    function register_dosen(){
        return view('Dosen.registerdosen');
    }

    public function register_dosen_post(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:dosen,nip',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Simpan ke users
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'dosen'
        ]);
        if(!$user){
            return redirect(route('register.dosen'))
            ->with("error", "Registrasi gagal.");
        }

        // Simpan ke dosen
        Dosen::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi dosen berhasil');
    }

    function register_mahasiswa(){
        return view('Mahasiswa.registermhs');
    }

    public function register_mahasiswa_post(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswa,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Simpan ke users
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'mahasiswa'
        ]);
        if(!$user){
            return redirect(route('register.mahasiswa'))
            ->with("error", "Registrasi gagal.");
        }

        // Simpan ke mahasiswa
        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi mahasiswa berhasil');
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function callback(Request $request)
    {
        $response = Http::asForm()->post(
            env('COGNITO_TOKEN_URL'),
            [
                'grant_type' => 'authorization_code',
                'client_id' => env('COGNITO_CLIENT_ID'),
                'client_secret' => env('COGNITO_CLIENT_SECRET'),
                'code' => $request->code,
                'redirect_uri' =>
                    env('COGNITO_REDIRECT_URI')
            ]
        );

        $tokens = $response->json();

        dd($tokens);
    }

}
