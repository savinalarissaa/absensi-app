<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\LambdaController;
use App\Http\Controllers\AuthManager;

Route::get('/home', function () {
    return view('welcome'); # test web
})->name('home');

Route::get('/', function () {
    return redirect(route('login'));
});

# LOGIN USER
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

# REGISTER AKUN
Route::get('/register/mahasiswa', [AuthManager::class, 'register_mahasiswa'])->name('register.mahasiswa');
Route::post('/register/mahasiswa', [AuthManager::class, 'register_mahasiswa_post'])->name('register.mahasiswa.post');
Route::get('/register/dosen', [AuthManager::class, 'register_dosen'])->name('register.dosen');
Route::post('/register/dosen', [AuthManager::class, 'register_dosen_post'])->name('register.dosen.post');

// ADMIN (BISA MELIHAT/EDIT SEGALA DATA)
// Route::get('/admin', [AdminController::class, 'index'])
//     ->middleware(['auth', 'admin']);

Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin', [AdminController::class, 'store']);
Route::get('/admin/{id}', [AdminController::class, 'show']);
Route::put('/admin/{id}', [AdminController::class, 'update']);
Route::delete('/admin/{id}', [AdminController::class, 'destroy']);

// USER MAHASISWA (Controller data mahasiswa)
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

// UPLOAD FOTO
Route::get('/upload', [LambdaController::class, 'index']);
Route::post('/upload', [LambdaController::class, 'upload'])->name('upload.s3');

// DOSEN (Controller data dosen)
Route::get('/dosen', [DosenController::class, 'index']);
Route::post('/dosen', [DosenController::class, 'store']);
Route::get('/dosen/{id}', [DosenController::class, 'show']);
Route::put('/dosen/{id}', [DosenController::class, 'update']);
Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);

// MATAKULIAH (Controller data matkul)
Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
Route::post('/mata-kuliah', [MataKuliahController::class, 'store']);
Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'show']);
Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update']);
Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy']);

// Kelas (Controller data sesi kelas)
Route::get('/kelas', [KelasController::class, 'index']);
Route::post('/kelas', [KelasController::class, 'store']);
Route::get('/kelas/{id}', [KelasController::class, 'show']);
Route::put('/kelas/{id}', [KelasController::class, 'update']);
Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

// Presensi/Kehadiran (Controller data kehadiran kelas)
Route::get('/presensi', [KehadiranController::class, 'index']);
Route::post('/presensi', [KehadiranController::class, 'store']);
Route::get('/presensi/{id}', [KehadiranController::class, 'show']);
Route::put('/presensi/{id}', [KehadiranController::class, 'update']);
Route::delete('/presensi/{id}', [KehadiranController::class, 'destroy']);