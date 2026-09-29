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
        $search = $request->input('search');
        $status = $request->input('status', 'all');

        $query = Kelas::with(['santri', 'pengajar', 'paketBelajar'])
            ->filterByMonthYear('created_at', $bulan, $tahun)
            ->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('santri', function ($sq) use ($search) {
                    $sq->where('nama', 'like', "%{$search}%");
                })->orWhereHas('pengajar', function ($sq) use ($search) {
                    $sq->where('nama', 'like', "%{$search}%");
                });
            });
        }

        if (!auth()->user()->isAdminOrSuperAdmin()) {
            if (auth()->user()->pengajar) {
                $query->where('pengajar_id', auth()->user()->pengajar->id);
            } else {
                $query->where('id', 0);
            }
        }

        $kelasList = $query->get();

        return view('kelas.index', compact('kelasList', 'bulan', 'tahun', 'search', 'status'));
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
        if (!auth()->user()->canManageKelas($kelas)) {
            abort(403, 'Akses ditolak.');
        }

        $kelas->load(['santri', 'pengajar', 'paketBelajar', 'evaluasi', 'presensis' => function ($query) {
            $query->orderBy('tanggal', 'asc');
        }]);

        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        if (!auth()->user()->canManageKelas($kelas)) {
            abort(403, 'Akses ditolak.');
        }

        $santris = Santri::all();
        $pengajars = Pengajar::all();
        $paketBelajars = PaketBelajar::all();
        return view('kelas.edit', compact('kelas', 'santris', 'pengajars', 'paketBelajars'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        if (!auth()->user()->canManageKelas($kelas)) {
            abort(403, 'Akses ditolak.');
        }

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
        if (!auth()->user()->canManageKelas($kelas)) {
            abort(403, 'Akses ditolak.');
        }

        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }

    public function duplicate(Kelas $kelas)
    {
        if (!auth()->user()->canManageKelas($kelas)) {
            abort(403, 'Akses ditolak.');
        }

        $newKelas = $kelas->replicate();
        $newKelas->status = 'berjalan';
        $newKelas->created_at = now();
        $newKelas->updated_at = now();
        $newKelas->save();

        return redirect()->route('kelas.show', $newKelas->id)->with('success', 'Paket berhasil dilanjutkan (Kelas baru dibuat).');
    }
}
