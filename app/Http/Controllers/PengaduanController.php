<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        // Ambil pengaduan milik user yang login
        $pengaduan = Pengaduan::where('id_user', Auth::id())
                        ->with('tanggapan')
                        ->get();

        return view('masyarakat.dashboard', compact('pengaduan'));
    }

    public function create()
    {
        return view('masyarakat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_pengaduan' => 'required|date',
            'isi' => 'required'
        ]);

        Pengaduan::create([
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'id_user' => Auth::id(),
            'isi' => $request->isi,
            'status' => 'menunggu'
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim');
    }
}
