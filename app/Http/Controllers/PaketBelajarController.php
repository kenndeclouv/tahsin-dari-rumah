<?php

namespace App\Http\Controllers;

use App\Models\PaketBelajar;
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
        $paketBelajars = PaketBelajar::latest()->get();
        return view('paket_belajar.index', compact('paketBelajars'));
    }

    public function create()
    {
        return view('paket_belajar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:online,offline',
            'nominal' => 'required|integer|min:0',
        ]);

        PaketBelajar::create($validated);
        return redirect()->route('paket_belajars.index')->with('success', 'Data Paket Belajar berhasil ditambahkan.');
    }

    public function edit(PaketBelajar $paketBelajar)
    {
        return view('paket_belajar.edit', compact('paketBelajar'));
    }

    public function update(Request $request, PaketBelajar $paketBelajar)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:online,offline',
            'nominal' => 'required|integer|min:0',
        ]);

        $paketBelajar->update($validated);
        return redirect()->route('paket_belajars.index')->with('success', 'Data Paket Belajar berhasil diperbarui.');
    }

    public function destroy(PaketBelajar $paketBelajar)
    {
        $paketBelajar->delete();
        return redirect()->route('paket_belajars.index')->with('success', 'Data Paket Belajar berhasil dihapus.');
    }
}
