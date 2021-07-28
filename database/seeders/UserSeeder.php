<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('123'),
                'role' => '1',
                'email' => 'admin@gmail.com',
                'activation_code' => 'admin' . Str::random(20),
                'active' => '1',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
            [
                'username' => 'guru',
                'password' => Hash::make('123'),
                'role' => '2',
                'email' => 'guru@gmail.com',
                'activation_code' => 'guru' . Str::random(20),
                'active' => '1',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
            [
                'username' => 'siswa',
                'password' => Hash::make('123'),
                'role' => '3',
                'email' => 'siswa@gmail.com',
                'activation_code' => 'siswa' . Str::random(20),
                'active' => '1',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
            [
                'username' => 'siswa2',
                'password' => Hash::make('123'),
                'role' => '3',
                'email' => 'siswa2@gmail.com',
                'activation_code' => 'siswa2' . Str::random(20),
                'active' => '1',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
            [
                'username' => 'siswa3',
                'password' => Hash::make('123'),
                'role' => '3',
                'email' => 'siswa3@gmail.com',
                'activation_code' => 'siswa3' . Str::random(20),
                'active' => '1',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
        ]);
    }
}
