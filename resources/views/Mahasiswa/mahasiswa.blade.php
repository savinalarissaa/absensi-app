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
    <h2>Data Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Hapus</th>
            </tr>
        </thead>

        <tbody>
            @forelse($mahasiswa as $m)
                <tr>
                    <td>{{ $m->id_mahasiswa }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->email }}</td>
                    <td>
                        <form action="/mahasiswa/{{ $m->id_mahasiswa }}" method="POST">
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
                    <td colspan="4">Data mahasiswa tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

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
    </div>
</body>

</html>