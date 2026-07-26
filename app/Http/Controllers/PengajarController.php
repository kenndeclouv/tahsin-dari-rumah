<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengajarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users:view')->only('index', 'show');
        $this->middleware('permission:users:create')->only('create', 'store');
        $this->middleware('permission:users:edit')->only('edit', 'update');
        $this->middleware('permission:users:delete')->only('destroy');
    }
    public function index()
    {
        $pengajars = User::role('pengajar')->latest()->get();
        return view('pengajars.index', compact('pengajars'));
    }

    public function create()
    {
        $customFields = \App\Models\PengajarField::orderBy('order')->get();
        return view('pengajars.create', compact('customFields'));
    }

    public function store(Request $request)
    {
        $customFields = \App\Models\PengajarField::orderBy('order')->get();
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'additional_data' => 'nullable|array',
        ];

        foreach ($customFields as $field) {
            if ($field->is_required) {
                $rules['additional_data.' . $field->name] = 'required';
            } else {
                $rules['additional_data.' . $field->name] = 'nullable';
            }
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
            'additional_data' => $validated['additional_data'] ?? [],
        ]);

        $user->assignRole('pengajar');

        return redirect()->route('pengajars.index')->with('success', 'Data pengajar berhasil ditambahkan.');
    }

    public function edit(User $pengajar)
    {
        $customFields = \App\Models\PengajarField::orderBy('order')->get();
        return view('pengajars.edit', compact('pengajar', 'customFields'));
    }

    public function update(Request $request, User $pengajar)
    {
        $customFields = \App\Models\PengajarField::orderBy('order')->get();
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengajar->id,
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'admin_notes' => 'nullable|string',
            'additional_data' => 'nullable|array',
        ];

        foreach ($customFields as $field) {
            if ($field->is_required) {
                $rules['additional_data.' . $field->name] = 'required';
            } else {
                $rules['additional_data.' . $field->name] = 'nullable';
            }
        }

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        $pengajar->name = $validated['name'];
        $pengajar->email = $validated['email'];
        $pengajar->jenis_kelamin = $validated['jenis_kelamin'];
        $pengajar->alamat = $validated['alamat'] ?? null;
        $pengajar->no_hp = $validated['no_hp'] ?? null;
        $pengajar->pendidikan_terakhir = $validated['pendidikan_terakhir'] ?? null;
        $pengajar->status = $validated['status'];
        $pengajar->admin_notes = $validated['admin_notes'] ?? null;
        $pengajar->additional_data = $validated['additional_data'] ?? [];
        
        if ($request->filled('password')) {
            $pengajar->password = bcrypt($validated['password']);
        }
        
        $pengajar->save();

        return redirect()->route('pengajars.index')->with('success', 'Data pengajar berhasil diperbarui.');
    }

    public function show(User $pengajar)
    {
        $customFields = \App\Models\PengajarField::orderBy('order')->get();
        // Load paket belajars for this pengajar
        $paketBelajars = \App\Models\PaketBelajar::with(['santri'])
            ->withCount('presensis')
            ->where('pengajar_id', $pengajar->id)
            ->latest()
            ->get();
            
        return view('pengajars.show', compact('pengajar', 'paketBelajars', 'customFields'));
    }

    public function destroy(User $pengajar)
    {
        $pengajar->delete();
        return redirect()->route('pengajars.index')->with('success', 'Data pengajar berhasil dihapus.');
    }
}
