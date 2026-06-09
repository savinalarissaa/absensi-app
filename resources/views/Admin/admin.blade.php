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
    {{-- DATA MAHASISWA --}}
    <div class="container mt-5">
        <h2 class="text-center">Data Mahasiswa</h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Hapus</th>
                </tr>
            </thead>

            <tbody>
                @forelse($mahasiswa as $m)
                    <tr>
                        {{-- <td>{{ $m->id_mahasiswa }}</td> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>{{ $m->nim }}</td>
                        <td>{{ $m->email }}</td>
                        <td>
                            <form action="/mahasiswa/{{ $m->id_mahasiswa }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Data mahasiswa tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- form tambah data mahasiswa --}}
        <div class="mt-4 p-3 bg-light rounded">
            <h3>Tambah Mahasiswa Baru</h3>

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

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- DATA DOSEN --}}
    <div class="container mt-5">
        <h2 class="text-center">Data Dosen</h2>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Hapus</th>
                </tr>
            </thead>

            <tbody>
                @forelse($dosen as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $d->id_dosen }}</td> --}}
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->nip }}</td>
                        <td>{{ $d->email }}</td>

                        <td class="action-buttons">
                            <form action="/dosen/{{ $d->id_dosen }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Data dosen tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Tambah Dosen --}}
        <div class="mt-4 p-3 bg-light rounded">
            <h3>Tambah Dosen Baru</h3>

            <form action="{{ route('register.dosen.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Dosen</label>
                    <input type="text"
                        class="form-control"
                        id="nama"
                        name="nama"
                        required>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text"
                        class="form-control"
                        id="nip"
                        name="nip"
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

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- DATA MATA KULIAH --}}
    <div class="container mt-5">
        <h2 class="text-center">Data Mata Kuliah</h2>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Kode</th>
                    <th>Hapus</th>
                </tr>
            </thead>

            <tbody>
                @forelse($matakuliah as $mk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mk->nama_matkul }}</td>
                        <td>{{ $mk->kode_matkul }}</td>

                        <td class="action-buttons">
                            <form action="/mata-kuliah/{{ $mk->id_matkul }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Data mata kuliah tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Tambah Mata Kuliah --}}
        <div class="mt-4 p-3 bg-light rounded">
            <h3>Tambah Mata Kuliah Baru</h3>

            <form action="{{ url('/mata-kuliah') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                    <input type="text"
                        class="form-control"
                        id="nama_matkul"
                        name="nama_matkul"
                        required>
                </div>

                <div class="mb-3">
                    <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                    <input type="text"
                        class="form-control"
                        id="kode_matkul"
                        name="kode_matkul"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- DATA KELAS --}}
    <div class="container mt-5">
        <h2 class="text-center">Data Sesi Kelas</h2>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Topik</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Hapus</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kelas as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->mataKuliah->nama_matkul }}</td>
                        <td>{{ $k->dosen->nama }}</td>
                        <td>{{ $k->topik }}</td>
                        <td>{{ $k->tanggal_kelas }}</td>
                        
                        <td>
                            {{ substr($k->jam_mulai, 0, 5) }}
                            -
                            {{ substr($k->jam_selesai, 0, 5) }}
                        </td>

                        <td class="action-buttons">
                            <form action="/kelas/{{ $k->id_kelas }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Data mata kuliah tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Tambah Sesi Kelas --}}
        <div class="mt-4 p-3 bg-light rounded">
            <h3>Tambah Sesi Kelas Baru</h3>

            <form action="/kelas" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Mata Kuliah</label>

                    <select name="id_matkul" required>
                        <option value="">-- Pilih Mata Kuliah --</option>

                        @foreach($matakuliah as $m)
                            <option value="{{ $m->id_matkul }}">
                                {{ $m->kode_matkul }} - {{ $m->nama_matkul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Dosen</label>

                    <select name="id_dosen" required>
                        <option value="">-- Pilih Dosen --</option>

                        @foreach($dosen as $d)
                            <option value="{{ $d->id_dosen }}">
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_kelas" required>
                </div>

                <div class="mb-3">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" required>
                </div>

                <div class="mb-3">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" required>
                </div>

                <div class="mb-3">
                    <label>Topik</label>
                    <input type="text" name="topik" required>
                </div>

                <button type="submit">
                    Simpan Kelas
                </button>
            </form>
        </div>
    </div>

    {{-- DATA KEHADIRAN --}}
    {{-- <div class="container mt-5">
        <h2 class="text-center">Data Kehadiran</h2>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Kode</th>
                    <th>Hapus</th>
                </tr>
            </thead>

            <tbody>
                @forelse($matakuliah as $mk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mk->nama_matkul }}</td>
                        <td>{{ $mk->kode_matkul }}</td>

                        <td class="action-buttons">
                            <form action="/mata-kuliah/{{ $mk->id_matkul }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Data mata kuliah tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Tambah Dosen --}}
        {{-- <div class="mt-4 p-3 bg-light rounded">
            <h3>Tambah Mata Kuliah Baru</h3>

            <form action="{{ url('/mata-kuliah') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                    <input type="text"
                        class="form-control"
                        id="nama_matkul"
                        name="nama_matkul"
                        required>
                </div>

                <div class="mb-3">
                    <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                    <input type="text"
                        class="form-control"
                        id="kode_matkul"
                        name="kode_matkul"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>  --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection