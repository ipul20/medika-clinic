<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poli = [
            [
                'nama' => 'umum',
            ],
            [
                'nama' => 'gigi',
            ]
        ];
        foreach ($poli as $key => $value) {
            Poli::create($value);
        }
    }
}
