<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark mb-0">
            Berikan Tanggapan
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0 mb-4 bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold text-muted text-uppercase small">Menanggapi Laporan #{{ $pengaduan->id }}</h6>
                        <p class="mb-1 fw-bold">{{ $pengaduan->user->name }} ({{ $pengaduan->tgl_pengaduan }})</p>
                        <p class="fst-italic text-secondary mb-0">"{{ Str::limit($pengaduan->isi, 150) }}"</p>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('tanggapan.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id }}">

                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Update Status Laporan</label>
                                {{-- <select name="status" id="status" class="form-select">
                                    <option value="0" {{ $pengaduan->status == '0' ? 'selected' : '' }}>Pending (Belum Proses)</option>
                                    <option value="proses" {{ $pengaduan->status == 'menunggu' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select> --}}
                            </div>

                            <div class="mb-4">
                                <label for="tanggapan" class="form-label fw-bold">Isi Tanggapan</label>
                                <textarea name="tanggapan"
                                          id="tanggapan"
                                          rows="5"
                                          class="form-control"
                                          placeholder="Tuliskan tanggapan atau tindakan yang telah dilakukan..."
                                          required></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Tanggapan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
