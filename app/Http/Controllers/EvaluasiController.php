<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajar;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:evaluasis:create')->only('create', 'store');
    }
    public function create($paketId)
    {
        $paket = PaketBelajar::with('santri')->findOrFail($paketId);

        // Cek authorization
        if (Auth::user()->pengajar?->id !== $paket->pengajar_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super-admin')) {
            abort(403);
        }

        if ($paket->status === 'selesai' || $paket->evaluasi()->exists()) {
            return redirect()->route('dashboard')->with('error', 'Evaluasi untuk paket ini sudah diisi.');
        }
        
        // Boleh diisi jika status menunggu_evaluasi (presensi penuh) atau bisa diakali sesuai rules,
        // tapi di sini kita wajibkan sudah menunggu_evaluasi.
        if ($paket->status === 'berjalan') {
            return redirect()->route('dashboard')->with('error', 'Paket masih berjalan, belum bisa dievaluasi.');
        }

        return view('evaluasi.create', compact('paket'));
    }

    public function store(Request $request, $paketId)
    {
        $paket = PaketBelajar::findOrFail($paketId);

        if (Auth::user()->pengajar?->id !== $paket->pengajar_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super-admin')) {
            abort(403);
        }

        if ($paket->status === 'selesai') {
            return redirect()->route('dashboard')->with('error', 'Evaluasi sudah ada.');
        }

        $request->validate([
            'perkembangan_bacaan' => 'required|string',
            'makhraj' => 'required|string',
            'tajwid' => 'required|string',
            'catatan_pengajar' => 'nullable|string',
            'saran_latihan' => 'nullable|string',
        ]);

        Evaluasi::create([
            'paket_belajar_id' => $paket->id,
            'perkembangan_bacaan' => $request->perkembangan_bacaan,
            'makhraj' => $request->makhraj,
            'tajwid' => $request->tajwid,
            'catatan_pengajar' => $request->catatan_pengajar,
            'saran_latihan' => $request->saran_latihan,
        ]);

        // Ubah status ke selesai
        $paket->update(['status' => 'selesai']);

        return redirect()->route('dashboard')->with('success', 'Evaluasi berhasil disimpan. Status paket sekarang Selesai.');
    }
}
