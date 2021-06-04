<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jadwal = [
            [
                'dokter_id' => 1,
                'sesi' => 1,
                'mulai' => '08:00',
                'selesai' => '10:00',
            ],
            [
                'dokter_id' => '2',
                'sesi' => 1,
                'mulai' => '10:00',
                'selesai' => '12:00',
            ],
            [
                'dokter_id' => '3',
                'sesi' => 1,
                'mulai' => '14:00',
                'selesai' => '16:00',
            ],
            [
                'dokter_id' => 4,
                'sesi' => 1,
                'mulai' => '08:00',
                'selesai' => '10:00',
            ],
            [
                'dokter_id' => 5,
                'sesi' => 1,
                'mulai' => '10:00',
                'selesai' => '12:00',
            ],
            [
                'dokter_id' => 6,
                'sesi' => 1,
                'mulai' => '12:00',
                'selesai' => '14:00',
            ],
            [
                'dokter_id' => 7,
                'sesi' => 1,
                'mulai' => '14:00',
                'selesai' => '17:00',
            ],

        ];
        foreach ($jadwal as $key => $value) {
            Jadwal::create($value);
        }
    }
}
