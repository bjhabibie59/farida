<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    // Menampilkan semua tanggapan (untuk petugas dan masyarakat)
    public function index()
    {
        if (Auth::user()->role == 'petugas' || Auth::user()->role == 'admin') {
            // Petugas/ admin lihat semua tanggapan
            $tanggapans = Tanggapan::with('pengaduan', 'petugas')->get();
        } else {
            // Masyarakat lihat tanggapan miliknya
            $tanggapans = Tanggapan::with('pengaduan', 'petugas')
                ->whereHas('pengaduan', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get();
        }

        return view('tanggapan.index', compact('tanggapans'));
    }

    // Menampilkan form create tanggapan (untuk petugas)
    public function create(Request $request)
    {
        $pengaduan_id = $request->pengaduan_id ?? null;
        return view('tanggapan.create', compact('pengaduan'));
    }

    // Simpan tanggapan baru
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'tanggapan' => 'required|string',
        ]);

        Tanggapan::create([
            'pengaduan_id' => $request->pengaduan_id,
            'petugas_id' => Auth::id(), // otomatis petugas yang login
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil dibuat!');
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
