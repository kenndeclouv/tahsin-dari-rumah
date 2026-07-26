<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajarFieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengajar_fields:view')->only('index', 'show');
        $this->middleware('permission:pengajar_fields:create')->only('create', 'store');
        $this->middleware('permission:pengajar_fields:edit')->only('edit', 'update');
        $this->middleware('permission:pengajar_fields:delete')->only('destroy');
    }

    public function index()
    {
        $fields = \App\Models\PengajarField::orderBy('order')->get();
        return view('pengajar_fields.index', compact('fields'));
    }

    public function create()
    {
        return view('pengajar_fields.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:pengajar_fields,name|regex:/^[a-z0-9_]+$/',
            'type' => 'required|in:text,number,textarea,select,radio,date',
            'options' => 'nullable|string',
            'is_required' => 'boolean',
            'order' => 'required|integer',
        ], [
            'name.regex' => 'Name must be lowercase alphanumeric and underscores only (e.g. status_pekerjaan).'
        ]);

        if ($request->filled('options')) {
            $validated['options'] = array_map('trim', explode(',', $validated['options']));
        } else {
            $validated['options'] = null;
        }

        $validated['is_required'] = $request->has('is_required');

        \App\Models\PengajarField::create($validated);
        return redirect()->route('pengajar_fields.index')->with('success', 'Field berhasil ditambahkan.');
    }

    public function edit(\App\Models\PengajarField $pengajarField)
    {
        return view('pengajar_fields.edit', compact('pengajarField'));
    }

    public function update(Request $request, \App\Models\PengajarField $pengajarField)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|regex:/^[a-z0-9_]+$/|unique:pengajar_fields,name,' . $pengajarField->id,
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

        $pengajarField->update($validated);
        return redirect()->route('pengajar_fields.index')->with('success', 'Field berhasil diperbarui.');
    }

    public function destroy(\App\Models\PengajarField $pengajarField)
    {
        $pengajarField->delete();
        return redirect()->route('pengajar_fields.index')->with('success', 'Field berhasil dihapus.');
    }
}
