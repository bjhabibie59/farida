<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark mb-0">
            Detail Pengaduan
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small">Tanggal Pengaduan:</span>
                            <span class="fw-bold d-block">{{ $pengaduan->tgl_pengaduan }}</span>
                        </div>
                        <div>
                            @if($pengaduan->status == '0')
                                <span class="badge bg-secondary px-3 py-2">Belum Ditanggapi</span>
                            @elseif($pengaduan->status == 'proses')
                                <span class="badge bg-warning text-dark px-3 py-2">Sedang Diproses</span>
                            @else
                                <span class="badge bg-success px-3 py-2">Selesai</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3 text-primary">Isi Laporan:</h5>
                        <p class="card-text fs-6 lh-lg">
                            {{ $pengaduan->isi }}
                        </p>

                        @if($pengaduan->foto)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-2">Bukti Foto:</h6>
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                                     class="img-fluid rounded border shadow-sm"
                                     style="max-height: 400px; width: auto;"
                                     alt="Bukti Pengaduan">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-bold">
                        <i class="bi bi-chat-left-text-fill me-2"></i> Tanggapan Petugas
                    </div>
                    <div class="card-body p-4">

                        @forelse($pengaduan->tanggapan as $t)
                            <div class="d-flex mb-4 border-bottom pb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bi bi-person-fill fs-5"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mt-0 mb-1 fw-bold">
                                        {{ optional($t->petugas)->name ?? 'Petugas' }}
                                        <span class="badge bg-info text-dark ms-2" style="font-size: 0.7rem">Petugas</span>
                                    </h6>
                                    <span class="text-muted small d-block mb-2">
                                        {{ $t->tgl_tanggapan }}
                                    </span>
                                    <p class="mb-0 text-dark">
                                        {{ $t->tanggapan }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <p>Belum ada tanggapan dari petugas.</p>
                            </div>
                        @endforelse

                    </div>
                </div>

                <div class="mt-4 mb-5">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
