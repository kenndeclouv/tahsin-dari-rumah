<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Presensi;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:presensis:create')->only('create', 'store');
        $this->middleware('permission:presensis:edit')->only('edit', 'update');
        $this->middleware('permission:presensis:delete')->only('destroy');
    }

    public function create($kelasId)
    {
        $kelas = Kelas::with('santri')->findOrFail($kelasId);

        if (!Auth::user()->canManageKelas($kelas)) {
            abort(403);
        }

        if ($kelas->isFull()) {
            return redirect()->route('kelas.index')->with('error', 'Kelas ini sudah mencapai batas maksimum pertemuan. Silakan isi evaluasi.');
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
            return redirect()->route('kelas.index')->with('error', 'Kelas ini sudah penuh.');
        }

        $request->validate([
            'catatan' => 'nullable|string'
        ]);

        $isLastMeeting = ($kelas->presensis()->count() + 1) >= $kelas->jumlah_pertemuan;

        if ($isLastMeeting) {
            $request->validate([
                'perkembangan_bacaan' => 'required|string',
                'makhraj' => 'required|string',
                'tajwid' => 'required|string',
                'catatan_pengajar' => 'nullable|string',
                'saran_latihan' => 'nullable|string',
            ]);
        }

        $tanggalSekarang = date('Y-m-d');

        // Cek agar presensi hanya 1 kali per tanggal untuk kelas ini
        $alreadyPresensi = Presensi::where('kelas_id', $kelas->id)
            ->whereDate('tanggal', $tanggalSekarang)
            ->exists();
        if ($alreadyPresensi && app()->isProduction()) {
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

        if ($isLastMeeting) {
            Evaluasi::create([
                'kelas_id' => $kelas->id,
                'perkembangan_bacaan' => $request->perkembangan_bacaan,
                'makhraj' => $request->makhraj,
                'tajwid' => $request->tajwid,
                'catatan_pengajar' => $request->catatan_pengajar,
                'saran_latihan' => $request->saran_latihan,
            ]);
            $kelas->update(['status' => 'selesai']);
            return redirect()->route('kelas.index')->with('success', 'Presensi dan Evaluasi akhir berhasil disimpan.');
        }

        return redirect()->route('kelas.index')->with('success', 'Presensi berhasil diisi.');
    }

    public function edit(Presensi $presensi)
    {
        if (!Auth::user()->hasRole(['admin', 'super-admin'])) {
            abort(403);
        }

        return view('presensi.edit', compact('presensi'));
    }

    public function update(Request $request, Presensi $presensi)
    {
        if (!Auth::user()->hasRole(['admin', 'super-admin'])) {
            abort(403);
        }

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kehadiran' => 'required|in:hadir,reschedule,libur',
            'catatan' => 'nullable|string'
        ]);

        $presensi->update($validated);

        return redirect()->route('kelas.show', $presensi->kelas_id)->with('success', 'Presensi berhasil diupdate.');
    }

    public function destroy(Presensi $presensi)
    {
        if (!Auth::user()->hasRole(['admin', 'super-admin'])) {
            abort(403);
        }
        
        $kelas_id = $presensi->kelas_id;
        $presensi->delete();

        return redirect()->route('kelas.show', $kelas_id)->with('success', 'Presensi berhasil dihapus.');
    }
}
