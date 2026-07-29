<?php

namespace Database\Seeders;

use App\Models\PaketBelajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketBelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaketBelajar::create([
            'nama' => 'Tahsin Privat 4x Pertemuan',
            'jenis' => 'online',
            'nominal' => 400000,
        ]);

        PaketBelajar::create([
            'nama' => 'Tahsin Privat 8x Pertemuan',
            'jenis' => 'online',
            'nominal' => 800000,
        ]);
    }
}
