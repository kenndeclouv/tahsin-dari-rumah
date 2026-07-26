<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fee::create([
            'nama' => 'Tahsin Privat 4x Pertemuan',
            'nominal' => 400000,
        ]);

        Fee::create([
            'nama' => 'Tahsin Privat 8x Pertemuan',
            'nominal' => 800000,
        ]);
    }
}
