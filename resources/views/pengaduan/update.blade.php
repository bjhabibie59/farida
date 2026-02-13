@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengaduan</h2>

    <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tanggal Pengaduan</label>
            <input type="date"
                   name="tgl_pengaduan"
                   class="form-control"
                   value="{{ $pengaduan->tanggal_pengaduan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Isi Laporan</label>
            <textarea name="isi"
                      class="form-control"
                      rows="4"
                      required>{{ $pengaduan->isi }}</textarea>
        </div>

        {{-- Status hanya bisa diubah admin --}}
        @if(auth()->user()->role == 'admin')
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        @else
            <input type="hidden" name="status" value="{{ $pengaduan->status }}">
        @endif

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
