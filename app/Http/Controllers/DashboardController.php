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
        $hariIni = strtolower(\Carbon\Carbon::now()->locale('id')->translatedFormat('l'));

        if ($user->isAdminOrSuperAdmin()) {
            $pengajarAktif = \App\Models\Pengajar::where('status', 'aktif')->count();
            $santriAktif = Santri::where('status', 'aktif')->count();
            
            $presensiHariIni = \App\Models\Presensi::whereDate('tanggal', \Carbon\Carbon::today())->count();

            $paketBerjalan = Kelas::berjalan()->count();
            $evaluasiBelumDibuat = Kelas::menungguEvaluasi()->count();
            $paketSelesai = Kelas::selesai()->count();
            $mukafaahSiap = Kelas::selesai()->where('payment_status', 'belum')->count();

            return view('dashboard', compact(
                'pengajarAktif', 
                'santriAktif', 
                'presensiHariIni',
                'paketBerjalan',
                'evaluasiBelumDibuat', 
                'paketSelesai',
                'mukafaahSiap'
            ));
        }

        $pengajarId = $user->pengajar?->id;

        $santriDiampu = $pengajarId ? Kelas::where('pengajar_id', $pengajarId)
            ->distinct('santri_id')
            ->count('santri_id') : 0;

        $kelasIdsDiampu = Kelas::where('pengajar_id', $pengajarId)->pluck('id');
        $presensiHariIni = \App\Models\Presensi::whereIn('kelas_id', $kelasIdsDiampu)
            ->whereDate('tanggal', \Carbon\Carbon::today())
            ->count();

        $evaluasiBelumDibuat = $pengajarId ? Kelas::where('pengajar_id', $pengajarId)
            ->menungguEvaluasi()->count() : 0;

        $mukafaahDiproses = $pengajarId ? Kelas::where('pengajar_id', $pengajarId)
            ->where('payment_status', 'lunas')->count() : 0;
            
        $daftarKelasAktif = $pengajarId ? Kelas::with('santri')->withCount('presensis')
            ->where('pengajar_id', $pengajarId)
            ->get() : collect();

        return view('dashboard', compact(
            'santriDiampu', 
            'presensiHariIni', 
            'evaluasiBelumDibuat', 
            'mukafaahDiproses',
            'daftarKelasAktif'
        ));
    }
}
