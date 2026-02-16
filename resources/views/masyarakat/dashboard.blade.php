<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark mb-0">
            Dashboard Masyarakat
        </h2>
    </x-slot>

    <div class="py-5"> <div class="container"> <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h3 class="h5 card-title mb-2 font-weight-bold">
                        Daftar Pengaduan dan Tanggapan
                    </h3>
                    <p class="text-muted small mb-4">
                        Berikut semua laporan yang telah Anda buat beserta tanggapan dari petugas.
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary"> <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Isi</th>
                                    <th>Status</th>
                                    <th>Tanggapan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduan as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->tgl_pengaduan }}</td>
                                        <td>{{ $p->isi }}</td>
                                        <td>
                                            @if($p->status == '0')
                                                <span class="badge bg-secondary">Belum Ditanggapi</span>
                                            @elseif($p->status == 'proses')
                                                <span class="badge bg-warning text-dark">Proses</span>
                                            @else
                                                <span class="badge bg-success">{{ $p->status }}</span>
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
                                        <td>
                                            <a href="{{ route('pengaduan.show', $p->id) }}"
                                               class="btn btn-sm btn-primary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Belum ada laporan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('pengaduan.create') }}" class="btn btn-success">
                            Buat Laporan Baru
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
