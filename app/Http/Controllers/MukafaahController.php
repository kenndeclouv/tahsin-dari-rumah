<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajar;
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
        // Ambil semua pengajar yang punya paket berstatus selesai
        $pengajars = \App\Models\User::role('pengajar')
            ->whereHas('paketBelajars', function ($query) {
                $query->where('paket_belajars.status', 'selesai');
            })
            ->with(['paketBelajars' => function ($query) {
                $query->where('paket_belajars.status', 'selesai')->with(['santri', 'evaluasi', 'fee']);
            }])
            ->get();
            
        return view('mukafaah.index', compact('pengajars'));
    }

    public function pay(Request $request, PaketBelajar $paket)
    {
        // Toggle payment status
        $paket->update([
            'payment_status' => $paket->payment_status === 'belum' ? 'lunas' : 'belum'
        ]);

        $statusText = $paket->payment_status === 'lunas' ? 'Lunas' : 'Belum Lunas';
        return redirect()->back()->with('success', "Status pembayaran paket {$paket->santri->nama} berhasil diubah menjadi {$statusText}.");
    }
}
