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
    {{-- DATA KEHADIRAN --}}
<div class="container mt-5">
    <h2 class="text-center">Presensi yang belum</h2>

    <div class="tab-content mt-3">

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item">
                <button
                    class="nav-link active"
                    data-bs-toggle="tab"
                    data-bs-target="#riwayat">
                    Riwayat Presensi
                </button>
            </li>

            <li class="nav-item">
                <button
                    class="nav-link"
                    data-bs-toggle="tab"
                    data-bs-target="#belum">
                    Belum Presensi
                </button>
            </li>

        </ul>
        
        {{-- RIWAYAT --}}
        <div class="tab-pane fade show active" id="riwayat">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Topik</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($kehadiran as $k)
                    <tr>
                        <td>{{ $k->kelas->mataKuliah->nama_matkul }}</td>
                        <td>{{ $k->kelas->topik }}</td>
                        <td>{{ $k->status }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

        {{-- BELUM PRESENSI --}}
        <div class="tab-pane fade" id="belum">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Topik</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($kelasBelumPresensi as $k)
                    <tr>
                        <td>{{ $k->mataKuliah->nama_matkul }}</td>
                        <td>{{ $k->topik }}</td>
                        <td>{{ $k->tanggal_kelas }}</td>
                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-4">
        <h2>Tambah Kehadiran</h2>
        <form action="/presensi" method="POST">
            @csrf
            <div>
                <label>Kelas</label>
                <input type="hidden"
                    name="id_mahasiswa"
                    value="{{ $mahasiswa->id_mahasiswa }}">

                <select name="id_kelas" required>
                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                        {{ $k->mataKuliah->nama_matkul }}
                            |
                            {{ $k->topik }}
                            |
                            {{ $k->tanggal_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <div>
                <label>Status</label>

                <select name="status" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpha">Alpha</option>
                </select>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">
                Simpan Kehadiran
            </button>

        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection