<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajarField;
use Illuminate\Http\Request;

class PaketBelajarFieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:paket_belajar_fields:view')->only('index', 'show');
        $this->middleware('permission:paket_belajar_fields:create')->only('create', 'store');
        $this->middleware('permission:paket_belajar_fields:edit')->only('edit', 'update');
        $this->middleware('permission:paket_belajar_fields:delete')->only('destroy');
    }

    public function index()
    {
        $fields = PaketBelajarField::orderBy('order')->get();
        return view('paket_belajar_fields.index', compact('fields'));
    }

    public function create()
    {
        return view('paket_belajar_fields.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:paket_belajar_fields,name|regex:/^[a-z0-9_]+$/',
            'type' => 'required|in:text,number,textarea,select,radio,date',
            'options' => 'nullable|string', // comma separated
            'is_required' => 'boolean',
            'order' => 'required|integer',
        ], [
            'name.regex' => 'Name must be lowercase alphanumeric and underscores only (e.g. tipe_kelas).'
        ]);

        if ($request->filled('options')) {
            $validated['options'] = array_map('trim', explode(',', $validated['options']));
        } else {
            $validated['options'] = null;
        }

        $validated['is_required'] = $request->has('is_required');

        PaketBelajarField::create($validated);
        return redirect()->route('paket_belajar_fields.index')->with('success', 'Field Paket Kelas berhasil ditambahkan.');
    }

    public function edit(PaketBelajarField $paketBelajarField)
    {
        return view('paket_belajar_fields.edit', compact('paketBelajarField'));
    }

    public function update(Request $request, PaketBelajarField $paketBelajarField)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|regex:/^[a-z0-9_]+$/|unique:paket_belajar_fields,name,' . $paketBelajarField->id,
            'type' => 'required|in:text,number,textarea,select,radio,date',
            'options' => 'nullable|string',
            'is_required' => 'boolean',
            'order' => 'required|integer',
        ]);

        if ($request->filled('options')) {
            $validated['options'] = array_map('trim', explode(',', $validated['options']));
        } else {
            $validated['options'] = null;
        }

        $validated['is_required'] = $request->has('is_required');

        $paketBelajarField->update($validated);
        return redirect()->route('paket_belajar_fields.index')->with('success', 'Field Paket Kelas berhasil diperbarui.');
    }

    public function destroy(PaketBelajarField $paketBelajarField)
    {
        $paketBelajarField->delete();
        return redirect()->route('paket_belajar_fields.index')->with('success', 'Field Paket Kelas berhasil dihapus.');
    }
}
