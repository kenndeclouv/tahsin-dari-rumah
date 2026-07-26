<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajarFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'name' => 'status_pekerjaan',
                'label' => 'Status Pekerjaan',
                'type' => 'select',
                'options' => ['Mahasiswa', 'Karyawan Swasta', 'PNS', 'Guru/Dosen', 'Wiraswasta', 'Lainnya'],
                'is_required' => false,
                'order' => 1,
            ],
            [
                'name' => 'pengalaman_mengajar',
                'label' => 'Pengalaman Mengajar (Tahun)',
                'type' => 'number',
                'options' => null,
                'is_required' => false,
                'order' => 2,
            ],
            [
                'name' => 'link_portofolio',
                'label' => 'Link Portofolio / CV',
                'type' => 'text',
                'options' => null,
                'is_required' => false,
                'order' => 3,
            ]
        ];

        foreach ($fields as $field) {
            \App\Models\PengajarField::create($field);
        }
    }
}
