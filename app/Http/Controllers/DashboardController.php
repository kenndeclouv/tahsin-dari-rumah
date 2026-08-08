<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $hariIni = \Carbon\Carbon::now()->translatedFormat('l');

        if ($user->isAdminOrSuperAdmin()) {
            $pengajarAktif = \App\Models\Pengajar::where('status', 'aktif')->count();
            $santriAktif = Santri::where('status', 'aktif')->count();
            
            $jadwalHariIniQuery = Kelas::where('hari_jam', 'like', "%{$hariIni}%")->berjalan();
            $jadwalHariIni = $jadwalHariIniQuery->count();
            
            $kelasIdsHariIni = $jadwalHariIniQuery->pluck('id');
            $presensiHariIni = \App\Models\Presensi::whereIn('kelas_id', $kelasIdsHariIni)
                ->whereDate('tanggal', \Carbon\Carbon::today())
                ->count();
            
            $presensiRatio = "{$presensiHariIni} dari {$jadwalHariIni}";

            $paketBerjalan = Kelas::berjalan()->count();
            $evaluasiBelumDibuat = Kelas::menungguEvaluasi()->count();
            $paketSelesai = Kelas::selesai()->count();
            $mukafaahSiap = Kelas::selesai()->where('payment_status', 'belum')->count();

            return view('dashboard', compact(
                'pengajarAktif', 
                'santriAktif', 
                'jadwalHariIni', 
                'presensiRatio',
                'paketBerjalan',
                'evaluasiBelumDibuat', 
                'paketSelesai',
                'mukafaahSiap'
            ));
        }

        $pengajarId = $user->pengajar?->id;

        $santriDiampu = $pengajarId ? Kelas::where('pengajar_id', $pengajarId)
            ->whereIn('status', ['berjalan', 'menunggu_evaluasi'])
            ->distinct('santri_id')
            ->count('santri_id') : 0;

        $jadwalHariIniQuery = Kelas::where('pengajar_id', $pengajarId)
            ->where('hari_jam', 'like', "%{$hariIni}%")
            ->berjalan();
        $jadwalHariIni = $pengajarId ? $jadwalHariIniQuery->count() : 0;

        $kelasIdsHariIni = $jadwalHariIniQuery->pluck('id');
        $presensiHariIni = \App\Models\Presensi::whereIn('kelas_id', $kelasIdsHariIni)
            ->whereDate('tanggal', \Carbon\Carbon::today())
            ->pluck('kelas_id')->toArray();
        $presensiBelumDiisi = $jadwalHariIni - count($presensiHariIni);

        $evaluasiBelumDibuat = $pengajarId ? Kelas::where('pengajar_id', $pengajarId)
            ->menungguEvaluasi()->count() : 0;

        $mukafaahDiproses = $pengajarId ? Kelas::where('pengajar_id', $pengajarId)
            ->where('payment_status', 'lunas')->count() : 0;
            
        $daftarKelasAktif = $pengajarId ? Kelas::with('santri')->withCount('presensis')
            ->where('pengajar_id', $pengajarId)
            ->whereIn('status', ['berjalan', 'menunggu_evaluasi'])
            ->get() : collect();

        return view('dashboard', compact(
            'santriDiampu', 
            'jadwalHariIni', 
            'presensiBelumDiisi', 
            'evaluasiBelumDibuat', 
            'mukafaahDiproses',
            'daftarKelasAktif'
        ));
    }
}
