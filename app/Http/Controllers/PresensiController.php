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
            'catatan' => 'nullable|string'
        ]);

        $tanggalSekarang = date('Y-m-d');

        // Cek agar presensi hanya 1 kali per tanggal untuk kelas ini
        $alreadyPresensi = Presensi::where('kelas_id', $kelas->id)
            ->whereDate('tanggal', $tanggalSekarang)
            ->exists();
        if ($alreadyPresensi) {
            return redirect()->back()->withInput()->with('error', 'Presensi untuk hari ini sudah diisi.');
        }

        $fotoPath = null;
        if ($request->filled('foto_base64')) {
            $imageParts = explode(";base64,", $request->foto_base64);
            $imageTypeAux = explode("image/", $imageParts[0]);
            $imageType = $imageTypeAux[1];
            $imageBase64 = base64_decode($imageParts[1]);
            $fileName = uniqid() . '.png'; // default to png from canvas
            
            \Illuminate\Support\Facades\Storage::disk('public')->put('presensi/' . $fileName, $imageBase64);
            $fotoPath = 'presensi/' . $fileName;
        }

        $nominalFee = null;
        if ($kelas->paketBelajar) {
            $nominalFee = $kelas->paketBelajar->nominal;
        }

        Presensi::create([
            'kelas_id' => $kelas->id,
            'tanggal' => $tanggalSekarang,
            'kehadiran' => 'hadir',
            'foto' => $fotoPath,
            'catatan' => $request->catatan,
            'nominal_fee' => $nominalFee,
        ]);

        // Jika ini pertemuan terakhir, ubah status ke menunggu_evaluasi
        $count = $kelas->presensis()->count();
        if ($count >= $kelas->jumlah_pertemuan) {
            $kelas->update(['status' => 'menunggu_evaluasi']);
            return redirect()->route('dashboard')->with('success', 'Presensi terakhir berhasil diisi. Silakan isi evaluasi kelas ini.');
        }

        return redirect()->route('dashboard')->with('success', 'Presensi berhasil diisi.');
    }
}
