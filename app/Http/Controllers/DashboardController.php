<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        return match ($role){
            'admin' => redirect()->route('admin.dashboard'),
            'petugas'=> redirect()->route('petugas.dashboard'),
            default => redirect()->route('masyarakat.dashboard'),
        };
    }
    public function admin()
    {
        return view('admin.dashboard');
    }
    public function petugas()
    {
        return view('petugas.dashboard');
    }
    public function masyarakat()
    {
        // $pengaduan = Pengaduan::where('id_user', Auth::id())
        //     ->with('tanggapan.petugas')
        //     ->get();

        return view('masyarakat.dashboard');
    }
}
