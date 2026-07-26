<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    private array $permissions = [
        'roles' => [
            'roles:view',
            'roles:create',
            'roles:edit',
            'roles:delete',
        ],
        'users' => [
            'users:view',
            'users:create',
            'users:edit',
            'users:delete',
        ],
        'santris' => [
            'santris:view',
            'santris:create',
            'santris:edit',
            'santris:delete',
        ],
        'paket_belajars' => [
            'paket_belajars:view',
            'paket_belajars:create',
            'paket_belajars:edit',
            'paket_belajars:delete',
        ],
        'presensis' => [
            'presensis:view',
            'presensis:create',
            'presensis:edit',
            'presensis:delete',
        ],
        'evaluasis' => [
            'evaluasis:view',
            'evaluasis:create',
            'evaluasis:edit',
            'evaluasis:delete',
        ],
        'fees' => [
            'fees:view',
            'fees:create',
            'fees:edit',
            'fees:delete',
        ],
        'mukafaahs' => [
            'mukafaahs:view',
            'mukafaahs:create',
            'mukafaahs:edit',
            'mukafaahs:delete',
        ],
        'santri_fields' => [
            'santri_fields:view',
            'santri_fields:create',
            'santri_fields:edit',
            'santri_fields:delete',
        ],
        'paket_belajar_fields' => [
            'paket_belajar_fields:view',
            'paket_belajar_fields:create',
            'paket_belajar_fields:edit',
            'paket_belajar_fields:delete',
        ],
        'pengajar_fields' => [
            'pengajar_fields:view',
            'pengajar_fields:create',
            'pengajar_fields:edit',
            'pengajar_fields:delete',
        ],
    ];

    public function run(): void
    {
        // Create all permissions
        foreach ($this->permissions as $module => $actions) {
            foreach ($actions as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'guard_name' => 'web',
                ]);
            }
        }

        // Create super-admin
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // Admin
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'santris:view', 'santris:create', 'santris:edit', 'santris:delete',
            'paket_belajars:view', 'paket_belajars:create', 'paket_belajars:edit', 'paket_belajars:delete',
            'presensis:view',
            'evaluasis:view',
            'fees:view', 'fees:create', 'fees:edit', 'fees:delete',
            'mukafaahs:view', 'mukafaahs:create', 'mukafaahs:edit', 'mukafaahs:delete',
            'santri_fields:view', 'santri_fields:create', 'santri_fields:edit', 'santri_fields:delete',
            'paket_belajar_fields:view', 'paket_belajar_fields:create', 'paket_belajar_fields:edit', 'paket_belajar_fields:delete',
            'pengajar_fields:view', 'pengajar_fields:create', 'pengajar_fields:edit', 'pengajar_fields:delete',
        ]);

        // Pengajar
        $pengajar = Role::firstOrCreate(['name' => 'pengajar', 'guard_name' => 'web']);
        $pengajar->syncPermissions([
            'paket_belajars:view',
            'presensis:view', 'presensis:create',
            'evaluasis:view', 'evaluasis:create',
        ]);

        $this->command->info('✅  Permissions and roles seeded.');
    }
}
