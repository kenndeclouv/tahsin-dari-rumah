<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:santris:view')->only('index', 'show');
        $this->middleware('permission:santris:create')->only('create', 'store');
        $this->middleware('permission:santris:edit')->only('edit', 'update');
        $this->middleware('permission:santris:delete')->only('destroy');
    }
    public function index()
    {
        $santris = Santri::latest()->get();
        // Ambil label fields untuk header tabel, atau tampilkan info dasar saja.
        return view('santris.index', compact('santris'));
    }

    public function create()
    {
        $fields = \App\Models\SantriField::orderBy('order')->get();
        return view('santris.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $fields = \App\Models\SantriField::all();
        $rules = [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'status' => 'required|in:aktif,selesai,nonaktif',
        ];

        foreach ($fields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';
            if ($field->type === 'number') {
                $rule .= '|numeric';
            }
            $rules['additional_data.' . $field->name] = $rule;
        }

        $validated = $request->validate($rules);

        $santri = Santri::create([
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'status' => $validated['status'],
            'additional_data' => $request->input('additional_data', []),
        ]);

        return redirect()->route('santris.index')->with('success', 'Santri berhasil ditambahkan.');
    }

    public function edit(Santri $santri)
    {
        $fields = \App\Models\SantriField::orderBy('order')->get();
        return view('santris.edit', compact('santri', 'fields'));
    }

    public function show(Santri $santri)
    {
        $paketBelajars = \App\Models\PaketBelajar::with(['pengajar'])
            ->where('santri_id', $santri->id)
            ->latest()
            ->get();
        return view('santris.show', compact('santri', 'paketBelajars'));
    }

    public function update(Request $request, Santri $santri)
    {
        $fields = \App\Models\SantriField::all();
        $rules = [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'status' => 'required|in:aktif,selesai,nonaktif',
        ];

        foreach ($fields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';
            if ($field->type === 'number') {
                $rule .= '|numeric';
            }
            $rules['additional_data.' . $field->name] = $rule;
        }

        $validated = $request->validate($rules);

        $santri->update([
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'status' => $validated['status'],
            'additional_data' => $request->input('additional_data', []),
        ]);

        return redirect()->route('santris.index')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();
        return redirect()->route('santris.index')->with('success', 'Data santri berhasil dihapus.');
    }
}
