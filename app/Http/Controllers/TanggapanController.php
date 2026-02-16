<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    // Menampilkan semua tanggapan (untuk petugas dan masyarakat)
    public function index()
    {
        // 1. Ambil semua data pengaduan (urutkan terbaru)
        // 'user' adalah relasi ke tabel users (pelapor)
        $pengaduan = Pengaduan::with('user')->orderBy('created_at', 'desc')->get();

        // 2. Hitung statistik untuk kartu dashboard
        $pending = Pengaduan::where('status', '0')->count();
        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        // 3. Tampilkan view yang baru kita buat
        return view('tanggapan.index', compact('pengaduan', 'pending', 'proses', 'selesai'));
    }

    // Menampilkan form create tanggapan (untuk petugas)
    public function create(Request $request, $id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);

        return view('tanggapan.create', compact('pengaduan'));
    }

    // Simpan tanggapan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id',
            'tanggapan' => 'required|string',
        ]);

        // 1. Update Status di tabel Pengaduan
        $pengaduan = Pengaduan::findOrFail($request->id_pengaduan);

        // 2. Simpan data ke tabel Tanggapan
        Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('petugas.dashboard')
            ->with('success', 'Tanggapan berhasil dikirim!');
    }

    // Menampilkan detail tanggapan
    public function show(Tanggapan $tanggapan)
    {
        return view('tanggapan.show', compact('tanggapan'));
    }

    // Menampilkan form edit tanggapan (opsional)
    public function edit(Tanggapan $tanggapan)
    {
        return view('tanggapan.edit', compact('tanggapan'));
    }

    // Update tanggapan
    public function update(Request $request, Tanggapan $tanggapan)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $tanggapan->update([
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil diupdate!');
    }

    // Hapus tanggapan
    public function destroy(Tanggapan $tanggapan)
    {
        $tanggapan->delete();

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil dihapus!');
    }
}
