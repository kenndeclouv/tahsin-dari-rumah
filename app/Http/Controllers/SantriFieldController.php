<?php

namespace App\Http\Controllers;

use App\Models\SantriField;
use Illuminate\Http\Request;

class SantriFieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:santri_fields:view')->only('index', 'show');
        $this->middleware('permission:santri_fields:create')->only('create', 'store');
        $this->middleware('permission:santri_fields:edit')->only('edit', 'update');
        $this->middleware('permission:santri_fields:delete')->only('destroy');
    }

    public function index()
    {
        $fields = \App\Models\SantriField::orderBy('order')->get();
        return view('santri_fields.index', compact('fields'));
    }

    public function create()
    {
        return view('santri_fields.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:santri_fields,name|regex:/^[a-z0-9_]+$/',
            'type' => 'required|in:text,number,textarea,select,radio,date',
            'options' => 'nullable|string', // We will accept comma separated string and save as array
            'is_required' => 'boolean',
            'order' => 'required|integer',
        ], [
            'name.regex' => 'Name must be lowercase alphanumeric and underscores only (e.g. asal_sekolah).'
        ]);

        if ($request->filled('options')) {
            $validated['options'] = array_map('trim', explode(',', $validated['options']));
        } else {
            $validated['options'] = null;
        }

        $validated['is_required'] = $request->has('is_required');

        SantriField::create($validated);
        return redirect()->route('santri_fields.index')->with('success', 'Field berhasil ditambahkan.');
    }

    public function edit(SantriField $santriField)
    {
        return view('santri_fields.edit', compact('santriField'));
    }

    public function update(Request $request, SantriField $santriField)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|regex:/^[a-z0-9_]+$/|unique:santri_fields,name,' . $santriField->id,
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

        $santriField->update($validated);
        return redirect()->route('santri_fields.index')->with('success', 'Field berhasil diperbarui.');
    }

    public function destroy(SantriField $santriField)
    {
        $santriField->delete();
        return redirect()->route('santri_fields.index')->with('success', 'Field berhasil dihapus.');
    }
}
