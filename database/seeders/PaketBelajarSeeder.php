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
            'jumlah_pertemuan' => 4,
            'nominal' => 400000,
        ]);

        PaketBelajar::create([
            'nama' => 'Tahsin Privat 8x Pertemuan',
            'jenis' => 'online',
            'jumlah_pertemuan' => 8,
            'nominal' => 800000,
        ]);
    }
}
