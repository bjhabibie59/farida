<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Petugas</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengaduan.index') }}">Daftar Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tanggapan.index') }}">Daftar Tanggapan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.show') }}">Profil Saya</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p>Ini adalah dashboard petugas. Dari sini Anda bisa melihat semua pengaduan dan menanggapi laporan masyarakat.</p>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Pengaduan</h5>
                        <p class="card-text">Lihat semua pengaduan dari masyarakat.</p>
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-success">Daftar Pengaduan</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Tanggapan</h5>
                        <p class="card-text">Lihat semua tanggapan yang sudah dibuat.</p>
                        <a href="{{ route('tanggapan.index') }}" class="btn btn-success">Daftar Tanggapan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
