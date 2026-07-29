<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            FeeSeeder::class,
            SantriFieldSeeder::class,
            PaketBelajarFieldSeeder::class,
            PengajarFieldSeeder::class,
        ]);

        $superadminUser = User::factory()->create([
            'name' => 'Kenndeclouv',
            'email' => 'kenndeclouv@gmail.com',
            'password' => bcrypt("kenndeclouv"),
        ]);

        $superadminUser->assignRole('super-admin');


        $pengajarUser = User::factory()->create([
            'name' => 'Pengajar Tahsin',
            'email' => 'pengajar@gmail.com',
            'password' => bcrypt("password"),
        ]);

        $pengajarUser->assignRole('pengajar');

        \App\Models\Pengajar::create([
            'user_id' => $pengajarUser->id,
            'nama' => $pengajarUser->name,
            'status' => 'aktif',
            'additional_data' => [
                'jenis_kelamin' => 'L',
                'no_hp' => '081234567890',
            ]
        ]);
    }
}
