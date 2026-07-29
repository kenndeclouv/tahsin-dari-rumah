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
                'name' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'type' => 'select',
                'options' => ['L', 'P'],
                'is_required' => true,
                'order' => 1,
            ],
            [
                'name' => 'no_hp',
                'label' => 'No. HP',
                'type' => 'text',
                'options' => null,
                'is_required' => true,
                'order' => 2,
            ],
            [
                'name' => 'alamat',
                'label' => 'Alamat Lengkap',
                'type' => 'textarea',
                'options' => null,
                'is_required' => true,
                'order' => 3,
            ],
            [
                'name' => 'pendidikan_terakhir',
                'label' => 'Pendidikan Terakhir',
                'type' => 'text',
                'options' => null,
                'is_required' => false,
                'order' => 4,
            ],
            [
                'name' => 'status_pekerjaan',
                'label' => 'Status Pekerjaan',
                'type' => 'select',
                'options' => ['Mahasiswa', 'Karyawan Swasta', 'PNS', 'Guru/Dosen', 'Wiraswasta', 'Lainnya'],
                'is_required' => false,
                'order' => 5,
            ],
            [
                'name' => 'pengalaman_mengajar',
                'label' => 'Pengalaman Mengajar (Tahun)',
                'type' => 'number',
                'options' => null,
                'is_required' => false,
                'order' => 6,
            ],
            [
                'name' => 'link_portofolio',
                'label' => 'Link Portofolio / CV',
                'type' => 'text',
                'options' => null,
                'is_required' => false,
                'order' => 7,
            ]
        ];

        foreach ($fields as $field) {
            \App\Models\PengajarField::create($field);
        }
    }
}
