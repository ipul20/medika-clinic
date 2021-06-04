<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\User;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dokter = [
            [
                'nip' => '202110001',
                'nama' => 'Dr Putri',
                'jenis_kelamin' => 'perempuan',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 1,
                'user_id' => 2
            ],
            [
                'nip' => '202110002',
                'nama' => 'Dr Yusuf',
                'jenis_kelamin' => 'laki-laki',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 1,
                'user_id' => 3
            ],
            [
                'nip' => '202110003',
                'nama' => 'Dr Syamsiar',
                'jenis_kelamin' => 'perempuan',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 1,
                'user_id' => 4
            ],
            [
                'nip' => '202120005',
                'nama' => 'Drg Asniwaty',
                'jenis_kelamin' => 'perempuan',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 2,
                'user_id' => 5
            ],
            [
                'nip' => '202120006',
                'nama' => 'Drg Xeriny',
                'jenis_kelamin' => 'perempuan',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 2,
                'user_id' => 6
            ],
            [
                'nip' => '202120007',
                'nama' => 'Drg Asniwati',
                'jenis_kelamin' => 'perempuan',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 2,
                'user_id' => 7
            ],
            [
                'nip' => '202120004',
                'nama' => 'Drg Effendy',
                'jenis_kelamin' => 'laki-laki',
                'nohp' => '',
                'alamat' => '',
                'poli_id' => 2,
                'user_id' => 8
            ],

        ];
        foreach ($dokter as $key => $value) {
            Dokter::create($value);
        }
        foreach ($dokter as $key => $data) {
            User::create([
                'name' => $data['nama'],
                'username' => $data['nip'],
                'password' => bcrypt($data['nip']),
                'password_default' => bcrypt($data['nip']),
                'role' => 'dokter',
            ]);
        }
    }
}
