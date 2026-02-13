@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Pengaduan</h2>

    {{-- Role: masyarakat --}}
    @if(auth()->user()->role == 'masyarakat')
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mb-3">
            + Buat Pengaduan
        </a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama User</th>
                <th>Isi Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tanggal_pengaduan }}</td>
                <td>{{ $p->user->nama ?? '-' }}</td>
                <td>{{ $p->isi }}</td>
                <td>
                    @if($p->status == 'pending')
                        <span class="badge bg-secondary">Pending</span>
                    @elseif($p->status == 'proses')
                        <span class="badge bg-warning">Proses</span>
                    @else
                        <span class="badge bg-success">Selesai</span>
                    @endif
                </td>
                <td>
                    {{-- masyarakat hanya lihat --}}
                    @if(auth()->user()->role == 'masyarakat')
                        <a href="{{ route('pengaduan.show', $p->id) }}" 
                           class="btn btn-info btn-sm">
                            Detail
                        </a>
                    @endif

                    {{-- petugas bisa tanggapi --}}
                    @if(auth()->user()->role == 'petugas')
                        <a href="{{ route('tanggapan.create', $p->id) }}" 
                           class="btn btn-success btn-sm">
                            Tanggapi
                        </a>
                    @endif

                    {{-- admin bisa hapus --}}
                    @if(auth()->user()->role == 'admin')
                        <form action="{{ route('pengaduan.destroy', $p->id) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
