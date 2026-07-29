<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:evaluasis:create')->only('create', 'store');
    }
    
    public function create($kelasId)
    {
        $kelas = Kelas::with('santri')->findOrFail($kelasId);

        // Cek authorization
        if (Auth::user()->pengajar?->id !== $kelas->pengajar_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super-admin')) {
            abort(403);
        }

        if ($kelas->status === 'selesai' || $kelas->evaluasi()->exists()) {
            return redirect()->route('dashboard')->with('error', 'Evaluasi untuk kelas ini sudah diisi.');
        }
        
        // Boleh diisi jika status menunggu_evaluasi (presensi penuh) atau bisa diakali sesuai rules,
        // tapi di sini kita wajibkan sudah menunggu_evaluasi.
        if ($kelas->status === 'berjalan') {
            return redirect()->route('dashboard')->with('error', 'Kelas masih berjalan, belum bisa dievaluasi.');
        }

        return view('evaluasi.create', compact('kelas'));
    }

    public function store(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        if (Auth::user()->pengajar?->id !== $kelas->pengajar_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super-admin')) {
            abort(403);
        }

        if ($kelas->status === 'selesai') {
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
            'kelas_id' => $kelas->id,
            'perkembangan_bacaan' => $request->perkembangan_bacaan,
            'makhraj' => $request->makhraj,
            'tajwid' => $request->tajwid,
            'catatan_pengajar' => $request->catatan_pengajar,
            'saran_latihan' => $request->saran_latihan,
        ]);

        // Ubah status ke selesai
        $kelas->update(['status' => 'selesai']);

        return redirect()->route('dashboard')->with('success', 'Evaluasi berhasil disimpan. Status kelas sekarang Selesai.');
    }
}
