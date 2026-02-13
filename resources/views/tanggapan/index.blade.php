<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tanggapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Tanggapan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Pengaduan</th>
            <th>Petugas</th>
            <th>Tanggal Tanggapan</th>
            <th>Tanggapan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tanggapans as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->pengaduan->judul ?? 'Tidak ada' }}</td>
                <td>{{ $t->petugas->name ?? 'Tidak ada' }}</td>
                <td>{{ $t->tgl_tanggapan }}</td>
                <td>{{ $t->tanggapan }}</td>
                <td>
                    <a href="{{ route('tanggapan.show', $t->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    @if(auth()->user()->role == 'petugas')
                        <a href="{{ route('tanggapan.edit', $t->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tanggapan.destroy', $t->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus tanggapan?')">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(auth()->user()->role == 'petugas')
        <a href="{{ route('tanggapan.create') }}" class="btn btn-primary mt-3">Buat Tanggapan Baru</a>
    @endif
</div>
</body>
</html>
