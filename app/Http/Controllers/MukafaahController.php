<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class MukafaahController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mukafaahs:view')->only('index', 'show');
        $this->middleware('permission:mukafaahs:edit')->only('pay');
    }
    
    public function index()
    {
        // Ambil semua pengajar yang punya kelas berstatus selesai
        $pengajars = \App\Models\User::role('pengajar')
            ->whereHas('kelas', function ($query) {
                $query->where('kelas.status', 'selesai');
            })
            ->with(['kelas' => function ($query) {
                $query->where('kelas.status', 'selesai')->with(['santri', 'evaluasi', 'paketBelajar']);
            }])
            ->get();
            
        return view('mukafaah.index', compact('pengajars'));
    }

    public function pay(Request $request, Kelas $kela)
    {
        // Toggle payment status
        $kela->update([
            'payment_status' => $kela->payment_status === 'belum' ? 'lunas' : 'belum'
        ]);

        $statusText = $kela->payment_status === 'lunas' ? 'Lunas' : 'Belum Lunas';
        return redirect()->back()->with('success', "Status pembayaran kelas {$kela->santri->nama} berhasil diubah menjadi {$statusText}.");
    }
}
