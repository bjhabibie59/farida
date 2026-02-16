<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark mb-0">
            Buat Pengaduan
        </h2>
    </x-slot>

    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Pengaduan</label>
                        <input type="date"
                               name="tgl_pengaduan"
                               value="{{ date('Y-m-d') }}"
                               class="form-control bg-light"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Laporan</label>
                        <textarea name="isi"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Tuliskan detail pengaduan Anda di sini..."
                                  required></textarea>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            Kirim Pengaduan
                        </button>

                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
