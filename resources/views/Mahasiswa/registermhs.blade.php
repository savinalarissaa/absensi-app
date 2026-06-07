@extends('layout')
@section('title', 'Dosen Registration')
@section('content')
    
<div class="container">
    <div class="mt-4 p-3 bg-light rounded">
        <h3>Registrasi Mahasiswa</h3>

        <form action="{{ route('register.mahasiswa.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text"
                    class="form-control"
                    id="nama"
                    name="nama"
                    required>
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text"
                    class="form-control"
                    id="nim"
                    name="nim"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                       class="form-control"
                    id="email"
                    name="email"
                    required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </form>
    </div>
</div>

@endsection