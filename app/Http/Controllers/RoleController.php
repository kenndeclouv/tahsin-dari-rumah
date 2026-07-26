<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles:view')->only(['index']);
        $this->middleware('can:roles:create')->only(['create', 'store']);
        $this->middleware('can:roles:edit')->only(['edit', 'update', 'permissions', 'updatePermissions']);
        $this->middleware('can:roles:delete')->only(['destroy']);
    }

    public function index()
    {
        $roles = Role::withCount('permissions')->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);

        Role::create(['name' => $request->name, 'guard_name' => 'web']);

        return redirect()->route('roles.index')
            ->with('success', "Role \"{$request->name}\" berhasil dibuat.");
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')
            ->with('success', "Role berhasil diperbarui menjadi \"{$request->name}\".");
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', "Role \"{$role->name}\" berhasil dihapus.");
    }

    // ─── Manage Permissions for a Role ───────────────────────────────────────

    public function permissions(Role $role)
    {
        // Group all permissions by module prefix (e.g., "roles" from "roles:view")
        $allPermissions = Permission::all()->groupBy(function ($permission) {
            return explode(':', $permission->name)[0];
        });

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.permissions', compact('role', 'allPermissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.permissions', $role)
            ->with('success', "Permissions untuk role \"{$role->name}\" berhasil diperbarui.");
    }
}
