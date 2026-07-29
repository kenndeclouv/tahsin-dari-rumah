<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajar;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek apakah admin
        $user = auth()->user();
        $hariIni = \Carbon\Carbon::now()->translatedFormat('l'); // 'Senin', 'Selasa', etc

        if ($user->hasRole('admin') || $user->hasRole('super-admin')) {
            // Admin stats
            $pengajarAktif = \App\Models\Pengajar::where('status', 'aktif')->count();
            $santriAktif = Santri::where('status', 'aktif')->count();
            
            // Jadwal Mengajar Hari Ini & Presensi Hari Ini
            $jadwalHariIniQuery = PaketBelajar::where('hari_jam', 'like', "%{$hariIni}%")->where('status', 'berjalan');
            $jadwalHariIni = $jadwalHariIniQuery->count();
            
            $paketIdsHariIni = $jadwalHariIniQuery->pluck('id');
            $presensiHariIni = \App\Models\Presensi::whereIn('paket_belajar_id', $paketIdsHariIni)
                ->whereDate('tanggal', \Carbon\Carbon::today())
                ->count();
            
            $presensiRatio = "{$presensiHariIni} dari {$jadwalHariIni}";

            $paketBerjalan = PaketBelajar::where('status', 'berjalan')->count();
            $evaluasiBelumDibuat = PaketBelajar::where('status', 'menunggu_evaluasi')->count();
            $paketSelesai = PaketBelajar::where('status', 'selesai')->count();
            $mukafaahSiap = PaketBelajar::where('status', 'selesai')->where('payment_status', 'belum')->count();

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

        // Pengajar stats
        $pengajarId = $user->pengajar?->id;

        $santriDiampu = $pengajarId ? PaketBelajar::where('pengajar_id', $pengajarId)
            ->whereIn('status', ['berjalan', 'menunggu_evaluasi'])
            ->distinct('santri_id')
            ->count('santri_id') : 0;

        $jadwalHariIniQuery = PaketBelajar::where('pengajar_id', $pengajarId)
            ->where('hari_jam', 'like', "%{$hariIni}%")
            ->where('status', 'berjalan');
        $jadwalHariIni = $pengajarId ? $jadwalHariIniQuery->count() : 0;

        // Presensi belum diisi (kelas hari ini yang belum dipresensi)
        $paketIdsHariIni = $jadwalHariIniQuery->pluck('id');
        $presensiHariIni = \App\Models\Presensi::whereIn('paket_belajar_id', $paketIdsHariIni)
            ->whereDate('tanggal', \Carbon\Carbon::today())
            ->pluck('paket_belajar_id')->toArray();
        $presensiBelumDiisi = $jadwalHariIni - count($presensiHariIni);

        $evaluasiBelumDibuat = $pengajarId ? PaketBelajar::where('pengajar_id', $pengajarId)
            ->where('status', 'menunggu_evaluasi')->count() : 0;

        $mukafaahDiproses = $pengajarId ? PaketBelajar::where('pengajar_id', $pengajarId)
            ->where('payment_status', 'lunas')->count() : 0;
            
        // Daftar Santri yang diajar beserta progress
        $daftarPaketAktif = $pengajarId ? PaketBelajar::with('santri')->withCount('presensis')
            ->where('pengajar_id', $pengajarId)
            ->whereIn('status', ['berjalan', 'menunggu_evaluasi'])
            ->get() : collect();

        return view('dashboard', compact(
            'santriDiampu', 
            'jadwalHariIni', 
            'presensiBelumDiisi', 
            'evaluasiBelumDibuat', 
            'mukafaahDiproses',
            'daftarPaketAktif'
        ));
    }
}
