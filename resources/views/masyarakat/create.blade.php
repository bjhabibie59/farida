@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Pengaduan</h2>

    <form action="{{ route('pengaduan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tanggal Pengaduan</label>
            <input type="date"
                   name="tgl_pengaduan"
                   value="{{ date('Y-m-d') }}"
                   class="form-control"
                   readonly>
        </div>

        <div class="mb-3">
            <label>Isi Laporan</label>
            <textarea name="isi"
                      class="form-control"
                      rows="4"
                      required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
