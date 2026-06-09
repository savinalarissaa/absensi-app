<!DOCTYPE html>
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
        <h2 class="text-center">Data Kehadiran</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    <th>Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Topik</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kehadiran as $k)
                    <tr>
                        {{-- <td>{{ $k->id_kehadiran }}</td>
                        <td>{{ $k->mahasiswa->nama }}</td>
                        <td>{{ $k->kelas->dosen->nama }}</td>
                        <td>{{ $k->kelas->mataKuliah->nama_matkul }}</td>
                        <td>{{ $k->kelas->topik }}</td>
                        <td>{{ $k->status }}</td>
                        <td>{{ $k->kelas->tanggal_kelas }}</td>
                        <td>
                            {{ substr($k->kelas->jam_mulai,0,5) }}
                            -
                            {{ substr($k->kelas->jam_selesai,0,5) }}
                        </td> --}}
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

                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Data kehadiran tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            <h2>Tambah Kehadiran</h2>

            <form action="/presensi" method="POST">
                @csrf

                <div>
                    <label>Mahasiswa</label>

                    <select name="id_mahasiswa" required>
                        <option value="">
                            -- Pilih Mahasiswa --
                        </option>

                        @foreach($mahasiswa as $m)
                            <option value="{{ $m->id_mahasiswa }}">
                                {{ $m->nim }} - {{ $m->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <br>

                <div>
                    <label>Kelas</label>

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

                    <select name="status" id="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Izin">Izin</option>
                        <option value="Alpha">Alpha</option>
                        <option value="Hadir">Hadir</option>
                    </select>
                </div>

                <br>

                <div id="foto-container" style="display:none;">
                    <label>Upload Foto Kehadiran</label>
                    <input
                        type="file"
                        name="foto"
                        accept="image/*"
                        class="form-control">
                </div>
                <br>

                <button type="submit">
                    Simpan Kehadiran
                </button>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>