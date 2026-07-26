<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajar;
use App\Models\PaketBelajarField;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;

class PaketBelajarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:paket_belajars:view')->only('index', 'show');
        $this->middleware('permission:paket_belajars:create')->only('create', 'store');
        $this->middleware('permission:paket_belajars:edit')->only('edit', 'update');
        $this->middleware('permission:paket_belajars:delete')->only('destroy');
    }

    public function index()
    {
        $pakets = PaketBelajar::with(['santri', 'pengajar', 'fee'])->latest()->get();
        return view('paket_belajar.index', compact('pakets'));
    }

    public function create()
    {
        $santris = Santri::all();
        $pengajars = User::role('pengajar')->get();
        $fees = \App\Models\Fee::all();
        $dynamicFields = PaketBelajarField::orderBy('order')->get();
        return view('paket_belajar.create', compact('santris', 'pengajars', 'fees', 'dynamicFields'));
    }

    public function store(Request $request)
    {
        $dynamicFields = PaketBelajarField::all();
        $dynamicRules = [];
        foreach ($dynamicFields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';
            if ($field->type === 'number') {
                $rule .= '|numeric';
            } elseif ($field->type === 'date') {
                $rule .= '|date';
            } else {
                $rule .= '|string';
            }
            $dynamicRules['additional_data.' . $field->name] = $rule;
        }

        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pengajar_id' => 'required|exists:users,id',
            'fee_id' => 'nullable|exists:fees,id',
            'hari_jam' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
        ] + $dynamicRules);

        $paketBelajar = new PaketBelajar($validated);
        $paketBelajar->additional_data = $request->input('additional_data', []);
        $paketBelajar->save();
        return redirect()->route('paket_belajars.index')->with('success', 'Paket Belajar berhasil ditugaskan.');
    }

    public function edit(PaketBelajar $paketBelajar)
    {
        $santris = Santri::all();
        $pengajars = User::role('pengajar')->get();
        $fees = \App\Models\Fee::all();
        $dynamicFields = PaketBelajarField::orderBy('order')->get();
        return view('paket_belajar.edit', compact('paketBelajar', 'santris', 'pengajars', 'fees', 'dynamicFields'));
    }

    public function update(Request $request, PaketBelajar $paketBelajar)
    {
        $dynamicFields = PaketBelajarField::all();
        $dynamicRules = [];
        foreach ($dynamicFields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';
            if ($field->type === 'number') {
                $rule .= '|numeric';
            } elseif ($field->type === 'date') {
                $rule .= '|date';
            } else {
                $rule .= '|string';
            }
            $dynamicRules['additional_data.' . $field->name] = $rule;
        }

        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pengajar_id' => 'required|exists:users,id',
            'fee_id' => 'nullable|exists:fees,id',
            'hari_jam' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'status' => 'required|in:berjalan,menunggu_evaluasi,selesai',
        ] + $dynamicRules);

        $paketBelajar->fill($validated);
        $paketBelajar->additional_data = $request->input('additional_data', []);
        $paketBelajar->save();
        return redirect()->route('paket_belajars.index')->with('success', 'Paket Belajar berhasil diperbarui.');
    }

    public function destroy(PaketBelajar $paketBelajar)
    {
        $paketBelajar->delete();
        return redirect()->route('paket_belajars.index')->with('success', 'Paket Belajar berhasil dihapus.');
    }
}
