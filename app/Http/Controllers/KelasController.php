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

        $query = Kelas::with(['santri', 'pengajar', 'paketBelajar'])->latest();

        if ($bulan !== 'all') {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun !== 'all') {
            $query->whereYear('created_at', $tahun);
        }

        $kelasList = $query->get();
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

    public function edit(Kelas $kelasItem)
    {
        $santris = Santri::all();
        $pengajars = Pengajar::all();
        $paketBelajars = PaketBelajar::all();
        return view('kelas.edit', compact('kelasItem', 'santris', 'pengajars', 'paketBelajars'));
    }

    public function update(Request $request, Kelas $kelasItem)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pengajar_id' => 'required|exists:pengajars,id',
            'paket_belajar_id' => 'nullable|exists:paket_belajars,id',
            'hari_jam' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'status' => 'required|in:berjalan,menunggu_evaluasi,selesai',
        ]);

        $kelasItem->update($validated);
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelasItem)
    {
        $kelasItem->delete();
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
