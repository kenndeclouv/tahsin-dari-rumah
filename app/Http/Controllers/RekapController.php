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

        $rekap = Presensi::with(['kelas.pengajar', 'kelas.paketBelajar'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('kehadiran', 'hadir')
            ->get()
            ->groupBy(function($item) {
                return $item->kelas->pengajar_id ?? 0;
            })
            ->map(function ($presensis) {
                $pengajar = $presensis->first()->kelas->pengajar ?? null;
                
                // Kalkulasi manual jika nominal_fee masih null (data lama)
                $estimasi = 0;
                foreach($presensis as $p) {
                    $fee = $p->nominal_fee;
                    if (is_null($fee) && $p->kelas && $p->kelas->paketBelajar) {
                        $fee = $p->kelas->paketBelajar->nominal;
                    }
                    $estimasi += $fee;
                }

                return [
                    'pengajar_nama' => $pengajar ? ($pengajar->nama ?? $pengajar->name) : 'Unknown',
                    'total_hadir' => $presensis->count(),
                    'estimasi_gaji' => $estimasi,
                ];
            });

        return view('rekap.pengajar', compact('rekap', 'bulan', 'tahun'));
    }

    public function santri(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $rekap = Presensi::with(['kelas.santri', 'kelas.paketBelajar'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('kehadiran', 'hadir')
            ->get()
            ->groupBy(function($item) {
                return $item->kelas->santri_id ?? 0;
            })
            ->map(function ($presensis) {
                $santri = $presensis->first()->kelas->santri ?? null;
                
                // Kalkulasi manual jika nominal_fee masih null (data lama)
                $estimasi = 0;
                foreach($presensis as $p) {
                    $fee = $p->nominal_fee;
                    if (is_null($fee) && $p->kelas && $p->kelas->paketBelajar) {
                        $fee = $p->kelas->paketBelajar->nominal;
                    }
                    $estimasi += $fee;
                }

                return [
                    'santri_nama' => $santri ? $santri->nama : 'Unknown',
                    'total_hadir' => $presensis->count(),
                    'estimasi_tagihan' => $estimasi,
                ];
            });

        return view('rekap.santri', compact('rekap', 'bulan', 'tahun'));
    }
}
