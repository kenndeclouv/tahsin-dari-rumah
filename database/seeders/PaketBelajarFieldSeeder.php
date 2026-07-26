<?php

namespace Database\Seeders;

use App\Models\PaketBelajarField;
use Illuminate\Database\Seeder;

class PaketBelajarFieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'name' => 'tipe_kelas',
                'label' => 'Tipe Kelas',
                'type' => 'select',
                'options' => ['Personal', 'Kelompok'],
                'is_required' => true,
                'order' => 1,
            ],
            [
                'name' => 'metode_belajar',
                'label' => 'Metode Belajar',
                'type' => 'select',
                'options' => ['Online', 'Offline (Tatap Muka)'],
                'is_required' => true,
                'order' => 2,
            ],
            [
                'name' => 'nama_paket',
                'label' => 'Nama Paket',
                'type' => 'select',
                'options' => ['Paket 4 sesi per bulan', 'Paket 8 sesi per bulan', 'Paket 12 sesi per bulan', 'Paket 16 sesi per bulan'],
                'is_required' => true,
                'order' => 3,
            ]
        ];

        foreach ($fields as $field) {
            PaketBelajarField::firstOrCreate(['name' => $field['name']], $field);
        }
    }
}
