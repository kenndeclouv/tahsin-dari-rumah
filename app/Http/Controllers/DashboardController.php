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
            $pengajarAktif = User::role('pengajar')->where('status', 'aktif')->count();
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
        $santriDiampu = PaketBelajar::where('pengajar_id', $user->id)
            ->whereIn('status', ['berjalan', 'menunggu_evaluasi'])
            ->distinct('santri_id')
            ->count('santri_id');

        $jadwalHariIniQuery = PaketBelajar::where('pengajar_id', $user->id)
            ->where('hari_jam', 'like', "%{$hariIni}%")
            ->where('status', 'berjalan');
        $jadwalHariIni = $jadwalHariIniQuery->count();

        // Presensi belum diisi (kelas hari ini yang belum dipresensi)
        $paketIdsHariIni = $jadwalHariIniQuery->pluck('id');
        $presensiHariIni = \App\Models\Presensi::whereIn('paket_belajar_id', $paketIdsHariIni)
            ->whereDate('tanggal', \Carbon\Carbon::today())
            ->pluck('paket_belajar_id')->toArray();
        $presensiBelumDiisi = $jadwalHariIni - count($presensiHariIni);

        $evaluasiBelumDibuat = PaketBelajar::where('pengajar_id', $user->id)
            ->where('status', 'menunggu_evaluasi')->count();

        $mukafaahDiproses = PaketBelajar::where('pengajar_id', $user->id)
            ->where('payment_status', 'lunas')->count();
            
        // Daftar Santri yang diajar beserta progress
        $daftarPaketAktif = PaketBelajar::with('santri')->withCount('presensis')
            ->where('pengajar_id', $user->id)
            ->whereIn('status', ['berjalan', 'menunggu_evaluasi'])
            ->get();

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
