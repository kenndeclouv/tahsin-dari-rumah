<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajar;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:presensis:create')->only('create', 'store');
    }
    public function create($paketId)
    {
        $paket = PaketBelajar::with('santri')->findOrFail($paketId);
        
        // Cek authorization
        if (Auth::id() !== $paket->pengajar_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super-admin')) {
            abort(403);
        }

        // Cek jika sudah penuh
        $count = $paket->presensis()->count();
        if ($count >= $paket->jumlah_pertemuan) {
            return redirect()->route('dashboard')->with('error', 'Paket ini sudah mencapai batas maksimum pertemuan. Silakan isi evaluasi.');
        }

        return view('presensi.create', compact('paket', 'count'));
    }

    public function store(Request $request, $paketId)
    {
        $paket = PaketBelajar::findOrFail($paketId);
        
        if (Auth::id() !== $paket->pengajar_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super-admin')) {
            abort(403);
        }

        $count = $paket->presensis()->count();
        if ($count >= $paket->jumlah_pertemuan) {
            return redirect()->route('dashboard')->with('error', 'Paket ini sudah penuh.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'kehadiran' => 'required|in:hadir,reschedule,libur',
            'foto' => 'nullable|image|max:5120', // Max 5MB
            'catatan' => 'nullable|string'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('presensi', 'public');
        }

        Presensi::create([
            'paket_belajar_id' => $paket->id,
            'tanggal' => $request->tanggal,
            'kehadiran' => $request->kehadiran,
            'foto' => $fotoPath,
            'catatan' => $request->catatan,
        ]);

        // Jika ini pertemuan terakhir, ubah status ke menunggu_evaluasi
        if ($count + 1 >= $paket->jumlah_pertemuan) {
            $paket->update(['status' => 'menunggu_evaluasi']);
            return redirect()->route('dashboard')->with('success', 'Presensi terakhir berhasil diisi. Silakan isi evaluasi paket ini.');
        }

        return redirect()->route('dashboard')->with('success', 'Presensi berhasil diisi.');
    }
}
