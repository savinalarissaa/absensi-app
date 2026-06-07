@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <form action="{{ route('login.post') }}" method="POST"
          class="mx-auto" style="max-width:500px">
        @csrf

        <h2 class="mb-4 text-center">
            Login Sistem Absensi
        </h2>

        <div class="mb-3">
            <label class="form-label">
                Email
            </label>
            <input
                type="email"
                name="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <div class="d-flex gap-2">
            <button
                type="submit"
                class="btn btn-primary">
                Login
            </button>

            <div class="dropdown">
                <button
                    class="btn btn-success dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">
                    Buat Akun
                </button>

                <ul class="dropdown-menu">
                    <li>
                        <a
                            class="dropdown-item"
                            href="{{ url('/register/mahasiswa') }}">
                            Mahasiswa
                        </a>
                    </li>

                    <li>
                        <a
                            class="dropdown-item"
                            href="{{ url('/register/dosen') }}">
                            Dosen
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
@endsection