<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Masyarakat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">
                    Daftar Pengaduan dan Tanggapan
                </h3>
                <p class="text-sm text-gray-600 mb-4">
                    Berikut semua laporan yang telah Anda buat beserta tanggapan dari petugas.
                </p>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Isi</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggapan</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pengaduan as $p)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $p->id }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $p->tgl_pengaduan }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $p->isi }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        {{ $p->status ?? 'Belum Ditanggapi' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm">
                                        @if($p->tanggapan->count() > 0)
                                            <ul class="list-disc pl-4">
                                                @foreach($p->tanggapan as $t)
                                                    <li>
                                                        {{ $t->tanggapan }}
                                                        <span class="text-xs text-gray-500">
                                                            (oleh: {{ $t->petugas->name ?? 'Petugas' }},
                                                            {{ $t->tgl_tanggapan }})
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-500">
                                                Belum ada tanggapan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-sm">
                                        <a href="{{ route('pengaduan.show', $p->id) }}"
                                           class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                        Belum ada laporan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route('pengaduan.create') }}"
                       class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Buat Laporan Baru
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
