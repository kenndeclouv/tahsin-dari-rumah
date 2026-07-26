<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:fees:view')->only('index', 'show');
        $this->middleware('permission:fees:create')->only('create', 'store');
        $this->middleware('permission:fees:edit')->only('edit', 'update');
        $this->middleware('permission:fees:delete')->only('destroy');
    }
    public function index()
    {
        $fees = Fee::latest()->get();
        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        return view('fees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nominal' => 'required|integer|min:0',
        ]);

        Fee::create($validated);
        return redirect()->route('fees.index')->with('success', 'Data Fee berhasil ditambahkan.');
    }

    public function edit(Fee $fee)
    {
        return view('fees.edit', compact('fee'));
    }

    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nominal' => 'required|integer|min:0',
        ]);

        $fee->update($validated);
        return redirect()->route('fees.index')->with('success', 'Data Fee berhasil diperbarui.');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Data Fee berhasil dihapus.');
    }
}
