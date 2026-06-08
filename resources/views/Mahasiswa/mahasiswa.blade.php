<!DOCTYPE html>
@extends('layout')
@section('title', 'Isi Presensi')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}  

    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 20px 50px;
            padding: 0;
        }
        
        .action-buttons {
            white-space: nowrap;
        }
        .action-buttons a {
            color:#000;
            text-decoration:none;
        }
        .table-responsive {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            margin-top: 25px;
            margin-left: 10px;
        }

        h2 {
            color: #333;
            margin-top: 30px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>

<body>
<div class="container mt-3">
    @auth
        <div>
            <h2>Selamat datang, <strong>{{ auth()->user()->name }}</strong> </h2>
        </div>
    @endauth
</div>

    {{-- DATA KEHADIRAN --}}
<div class="container mt-5">
    <h2 class="text-center">Presensi</h2>

    <ul class="nav nav-tabs" id="myTab" role="tablist">

    <li class="nav-item">
        <button
            class="nav-link active"
            data-bs-toggle="tab"
            data-bs-target="#belum">
            Belum Presensi
        </button>
    </li>

    <li class="nav-item">
        <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#riwayat">
            Riwayat Presensi
        </button>
    </li>

</ul>

    <div class="tab-content mt-3">

        {{-- BELUM PRESENSI --}}
        <div class="tab-pane fade show active" id="belum">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Topik</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kelasBelumPresensi as $k)
                    <tr>
                        <td>{{ $k->mataKuliah->nama_matkul }}</td>
                        <td>{{ $k->topik }}</td>
                        <td>{{ $k->tanggal_kelas }}</td>

                        <td>

                            {{-- Tombol Hadir --}}
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                onclick="showUpload({{ $k->id_kelas }})">
                                Hadir
                            </button>

                            {{-- IZIN --}}
                            <form action="/presensi" method="POST" style="display:inline">
                                @csrf

                                <input type="hidden"
                                    name="id_mahasiswa"
                                    value="{{ $mahasiswa->id_mahasiswa }}">

                                <input type="hidden"
                                    name="id_kelas"
                                    value="{{ $k->id_kelas }}">

                                <input type="hidden"
                                    name="status"
                                    value="Izin">

                                <button type="submit"
                                    class="btn btn-warning btn-sm">
                                    Izin
                                </button>
                            </form>

                            {{-- SAKIT --}}
                            <form action="/presensi" method="POST" style="display:inline">
                                @csrf

                                <input type="hidden"
                                    name="id_mahasiswa"
                                    value="{{ $mahasiswa->id_mahasiswa }}">

                                <input type="hidden"
                                    name="id_kelas"
                                    value="{{ $k->id_kelas }}">

                                <input type="hidden"
                                    name="status"
                                    value="Sakit">

                                <button type="submit"
                                    class="btn btn-secondary btn-sm">
                                    Sakit
                                </button>
                            </form>

                            {{-- ALPHA --}}
                            <form action="/presensi" method="POST" style="display:inline">
                                @csrf

                                <input type="hidden"
                                    name="id_mahasiswa"
                                    value="{{ $mahasiswa->id_mahasiswa }}">

                                <input type="hidden"
                                    name="id_kelas"
                                    value="{{ $k->id_kelas }}">

                                <input type="hidden"
                                    name="status"
                                    value="Alpha">

                                <button type="submit"
                                    class="btn btn-danger btn-sm">
                                    Alpha
                                </button>
                            </form>

                            {{-- Form Upload (hidden) --}}
                            <form
                                id="upload-{{ $k->id_kelas }}"
                                action="/presensi"
                                method="POST"
                                enctype="multipart/form-data"
                                style="display:none; margin-top:10px;">

                                @csrf

                                <input type="hidden"
                                    name="id_mahasiswa"
                                    value="{{ $mahasiswa->id_mahasiswa }}">

                                <input type="hidden"
                                    name="id_kelas"
                                    value="{{ $k->id_kelas }}">

                                <input type="hidden"
                                    name="status"
                                    value="Hadir">

                                <input
                                    type="file"
                                    name="foto"
                                    accept="image/*"
                                    required>

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-sm mt-1">
                                    Upload & Simpan
                                </button>

                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            Tidak ada kelas yang perlu dipresensi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- RIWAYAT --}}
        <div class="tab-pane fade" id="riwayat">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Topik</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kehadiran as $k)
                    <tr>
                        <td>{{ $k->kelas->mataKuliah->nama_matkul }}</td>
                        <td>{{ $k->kelas->topik }}</td>
                        <td>{{ $k->status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            Belum ada riwayat presensi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function showUpload(idKelas) {

    let form = document.getElementById('upload-' + idKelas);

    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection