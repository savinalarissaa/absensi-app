<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard Mahasiswa</title>

    <style>
        table {
            border-collapse: collapse;
            width: 80%;
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
        <h2>Data kelas</h2>
    <table>
        <thead>
            <tr>
                <th>ID Kelas</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Tanggal</th>
                <th>Hapus</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kelas as $k)
                <tr>
                    <td>{{ $k->id_kelas }}</td>
                    <td>{{ $k->mataKuliah->kode_matkul }}</td>
                    <td>{{ $k->mataKuliah->nama_matkul }}</td>
                    <td>{{ $k->dosen->nama }}</td>
                    <td>{{ $k->tanggal }}</td>

                    <td>
                        <form action="/kelas/{{ $k->id_kelas }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        Data kelas tidak ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
{{-- 
    <div class="mt-4 p-3 bg-light rounded">
        <h2>Tambah Mahasiswa Baru</h2>

        <form action="{{ url('/mahasiswa') }}" method="POST">
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
    </div> --}}
</body>

</html>