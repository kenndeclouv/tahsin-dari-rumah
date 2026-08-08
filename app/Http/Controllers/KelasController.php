<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PaketBelajar;
use App\Models\Santri;
use App\Models\Pengajar;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kelas:view')->only('index', 'show');
        $this->middleware('permission:kelas:create')->only('create', 'store');
        $this->middleware('permission:kelas:edit')->only('edit', 'update');
        $this->middleware('permission:kelas:delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $kelasList = Kelas::with(['santri', 'pengajar', 'paketBelajar'])
            ->filterByMonthYear('created_at', $bulan, $tahun)
            ->latest()
            ->get();

        return view('kelas.index', compact('kelasList', 'bulan', 'tahun'));
    }

    public function create()
    {
        $santris = Santri::all();
        $pengajars = Pengajar::all();
        $paketBelajars = PaketBelajar::all();
        return view('kelas.create', compact('santris', 'pengajars', 'paketBelajars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pengajar_id' => 'required|exists:pengajars,id',
            'paket_belajar_id' => 'nullable|exists:paket_belajars,id',
            'hari_jam' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
        ]);

        Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kelas)
    {
        $kelas->load(['santri', 'pengajar', 'paketBelajar', 'evaluasi', 'presensis' => function ($query) {
            $query->orderBy('tanggal', 'asc');
        }]);

        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        $santris = Santri::all();
        $pengajars = Pengajar::all();
        $paketBelajars = PaketBelajar::all();
        return view('kelas.edit', compact('kelas', 'santris', 'pengajars', 'paketBelajars'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pengajar_id' => 'required|exists:pengajars,id',
            'paket_belajar_id' => 'nullable|exists:paket_belajars,id',
            'hari_jam' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'status' => 'required|in:berjalan,menunggu_evaluasi,selesai',
        ]);

        $kelas->update($validated);
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
