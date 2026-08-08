<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SantriFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'label' => 'Nama Wali Santri',
                'name' => 'nama_wali',
                'type' => 'text',
                'options' => null,
                'is_required' => true,
                'order' => 1,
            ],
            [
                'label' => 'Jenis Kelamin',
                'name' => 'jenis_kelamin',
                'type' => 'select',
                'options' => ['Laki-laki', 'Perempuan'],
                'is_required' => true,
                'order' => 2,
            ],
            [
                'label' => 'Usia',
                'name' => 'usia',
                'type' => 'number',
                'options' => null,
                'is_required' => true,
                'order' => 2,
            ],
            [
                'label' => 'Privat / Kelompok',
                'name' => 'tipe_kelas',
                'type' => 'select',
                'options' => ['Privat', 'Kelompok'],
                'is_required' => true,
                'order' => 3,
            ],
            [
                'label' => 'Alamat Lengkap',
                'name' => 'alamat',
                'type' => 'textarea',
                'options' => null,
                'is_required' => true,
                'order' => 4,
            ],
            [
                'label' => 'Jadwal Opsi 1 (Hari & Jam)',
                'name' => 'jadwal_opsi_1',
                'type' => 'text',
                'options' => null,
                'is_required' => true,
                'order' => 5,
            ]
        ];

        foreach ($fields as $field) {
            \App\Models\SantriField::updateOrCreate(
                ['name' => $field['name']],
                $field
            );
        }
    }
}
