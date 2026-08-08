<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;

class RekapController extends Controller
{
    public function __construct()
    {
        // Admin middleware or permissions should be applied in routes
    }

    public function pengajar(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $query = \App\Models\Kelas::with(['pengajar', 'paketBelajar'])
            ->selesai()
            ->filterByMonthYear('updated_at', $bulan, $tahun)
            ->latest('updated_at');

        if (!auth()->user()->isAdminOrSuperAdmin()) {
            if (auth()->user()->pengajar) {
                $query->where('pengajar_id', auth()->user()->pengajar->id);
            } else {
                $query->where('id', 0);
            }
        }

        $rekap = $query->get();

        return view('rekap.pengajar', compact('rekap', 'bulan', 'tahun'));
    }

    public function santri(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $query = \App\Models\Kelas::with(['santri', 'paketBelajar'])
            ->selesai()
            ->filterByMonthYear('updated_at', $bulan, $tahun)
            ->latest('updated_at');

        if (!auth()->user()->isAdminOrSuperAdmin()) {
            if (auth()->user()->pengajar) {
                $query->where('pengajar_id', auth()->user()->pengajar->id);
            } else {
                $query->where('id', 0);
            }
        }

        $rekap = $query->get();

        return view('rekap.santri', compact('rekap', 'bulan', 'tahun'));
    }
}
