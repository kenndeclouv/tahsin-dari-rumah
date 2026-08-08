<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:presensis:create')->only('create', 'store');
    }

    public function create($kelasId)
    {
        $kelas = Kelas::with('santri')->findOrFail($kelasId);

        if (!Auth::user()->canManageKelas($kelas)) {
            abort(403);
        }

        if ($kelas->isFull()) {
            return redirect()->route('dashboard')->with('error', 'Kelas ini sudah mencapai batas maksimum pertemuan. Silakan isi evaluasi.');
        }

        $count = $kelas->presensis()->count();
        return view('presensi.create', compact('kelas', 'count'));
    }

    public function store(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        if (!Auth::user()->canManageKelas($kelas)) {
            abort(403);
        }

        if ($kelas->isFull()) {
            return redirect()->route('dashboard')->with('error', 'Kelas ini sudah penuh.');
        }

        $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'kehadiran' => 'required|in:hadir,reschedule,libur',
            'foto' => 'nullable|image|max:5120', // Max 5MB
            'catatan' => 'nullable|string'
        ]);

        // Cek agar presensi hanya 1 kali per tanggal untuk kelas ini
        $alreadyPresensi = Presensi::where('kelas_id', $kelas->id)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();
        if ($alreadyPresensi) {
            return redirect()->back()->withInput()->with('error', 'Presensi untuk tanggal tersebut sudah diisi.');
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('presensi', 'public');
        }

        $nominalFee = null;
        if ($request->kehadiran === 'hadir' && $kelas->paketBelajar) {
            $nominalFee = $kelas->paketBelajar->nominal;
        }

        Presensi::create([
            'kelas_id' => $kelas->id,
            'tanggal' => $request->tanggal,
            'kehadiran' => $request->kehadiran,
            'foto' => $fotoPath,
            'catatan' => $request->catatan,
            'nominal_fee' => $nominalFee,
        ]);

        // Jika ini pertemuan terakhir, ubah status ke menunggu_evaluasi
        if ($count + 1 >= $kelas->jumlah_pertemuan) {
            $kelas->update(['status' => 'menunggu_evaluasi']);
            return redirect()->route('dashboard')->with('success', 'Presensi terakhir berhasil diisi. Silakan isi evaluasi kelas ini.');
        }

        return redirect()->route('dashboard')->with('success', 'Presensi berhasil diisi.');
    }
}
