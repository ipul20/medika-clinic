<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //         \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(PoliSeeder::class);
        $this->call(DokterSeeder::class);
        $this->call(JadwalSeeder::class);
        //        $this->call(User::class);

    }
}
