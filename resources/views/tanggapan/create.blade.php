<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Tanggapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Buat Tanggapan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tanggapan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pengaduan_id" class="form-label">Pengaduan</label>
            <input type="text" class="form-control" id="pengaduan_id" name="pengaduan_id"
                   value="{{ $pengaduan_id ?? old('pengaduan_id') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tanggapan" class="form-label">Tanggapan</label>
            <textarea class="form-control" id="tanggapan" name="tanggapan" rows="5" required>{{ old('tanggapan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
        <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
