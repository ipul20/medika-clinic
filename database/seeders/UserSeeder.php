<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('123'),
                'password_default' => bcrypt('123'),
                'role' => 'admin'
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
