<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class MukafaahController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mukafaahs:view')->only('index', 'show');
        $this->middleware('permission:mukafaahs:edit')->only('pay', 'payAll');
    }
    
    public function index(Request $request)
    {
        $pengajarFilter = $request->get('pengajar_id');

        // Ambil semua pengajar yang punya kelas berstatus selesai
        $query = \App\Models\User::role('pengajar')
            ->whereHas('kelas', function ($q) {
                $q->where('kelas.status', 'selesai');
            })
            ->with(['kelas' => function ($q) {
                $q->where('kelas.status', 'selesai')->with(['santri', 'evaluasi', 'paketBelajar']);
            }]);

        // List pengajar untuk dropdown (hanya yang punya kelas selesai)
        $listPengajars = (clone $query)->get();

        if ($pengajarFilter) {
            $query->where('id', $pengajarFilter);
        }

        $pengajars = $query->get();
            
        return view('mukafaah.index', compact('pengajars', 'listPengajars', 'pengajarFilter'));
    }

    public function pay(Request $request, Kelas $kelas)
    {
        // Toggle payment status
        $kelas->update([
            'payment_status' => $kelas->payment_status === 'belum' ? 'lunas' : 'belum'
        ]);

        $statusText = $kelas->payment_status === 'lunas' ? 'Lunas' : 'Belum Lunas';
        return redirect()->back()->with('success', "Status pembayaran kelas {$kelas->santri->nama} berhasil diubah menjadi {$statusText}.");
    }

    public function payAll(Request $request, \App\Models\User $pengajar)
    {
        Kelas::where('pengajar_id', $pengajar->pengajar->id)
            ->where('status', 'selesai')
            ->where('payment_status', 'belum')
            ->update(['payment_status' => 'lunas']);

        return redirect()->back()->with('success', "Semua kelas selesai milik {$pengajar->name} berhasil ditandai Lunas.");
    }
}
