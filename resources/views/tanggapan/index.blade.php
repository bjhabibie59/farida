<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark mb-0">
            Dashboard Petugas
        </h2>
    </x-slot>

    <div class="container py-4">

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-secondary border-4">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold small">Belum Ditanggapi</h6>
                        <h2 class="mb-0 fw-bold text-secondary">{{ $pending ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-warning border-4">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold small">Sedang Proses</h6>
                        <h2 class="mb-0 fw-bold text-warning">{{ $proses ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-success border-4">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold small">Selesai</h6>
                        <h2 class="mb-0 fw-bold text-success">{{ $selesai ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-inbox-fill me-2"></i> Laporan Masuk
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">ID</th>
                                <th>Tanggal</th>
                                <th>Pelapor</th>
                                <th>Isi Laporan</th>
                                <th>Status</th>
                                <th>Tanggapan</th>
                                <th class="text-end px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduan as $p)
                                <tr>
                                    <td class="px-4 fw-bold">#{{ $p->id }}</td>
                                    <td>{{ $p->tgl_pengaduan }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $p->user->name ?? 'Anonim' }}</span>
                                    </td>
                                    <td>
                                        {{ Str::limit($p->isi, 50) }}
                                    </td>
                                    <td>
                                        @if($p->status == '0')
                                            <span class="badge bg-secondary">Pending</span>
                                        @elseif($p->status == 'proses')
                                            <span class="badge bg-warning text-dark">Proses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->tanggapan && $p->tanggapan->count() > 0)
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($p->tanggapan as $t)
                                                        <li class="mb-2">
                                                            <i class="bi bi-chat-right-text-fill text-info"></i>
                                                            {{ $t->tanggapan }}
                                                            <div class="text-muted" style="font-size: 0.75rem;">
                                                                (oleh: {{ optional($t->petugas)->name ?? 'Petugas' }}, {{ $t->tgl_tanggapan }})
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-muted small">Belum ada tanggapan</span>
                                            @endif
                                    </td>
                                    <td class="text-end px-4">
                                        <a href="{{ route('tanggapan.create', $p->id) }}"
                                        class="btn btn-sm btn-success text-white">
                                            <i class="bi bi-pencil-square me-1"></i> Tanggapi
                                        </a>

                                        <a href="{{ route('pengaduan.show', $p->id) }}"
                                        class="btn btn-sm btn-outline-primary ms-1">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        Tidak ada laporan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
