<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_guru')->insert([
            [
                'user_id'=>'2',
                'nama' => 'Jhon does',
                'nip' => 12030394,
                'alamat' => 'jl sejahtera gang ciawi',
                'agama' => 'islam',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'bogor',
                'tanggal_lahir' => date('1990-07-21'),
                'email'=>'jhon@gmail.com',
                'foto'=>'avatar.png',
                'created_at' => date(now()),
                'updated_at' => date(now())
            ],
            // [
            //     'nama' => 'Jhon dani',
            //     'nip' => 12093413,
            //     'alamat' => 'jl miskin gang ciawi',
            //     'agama' => 'islam',
            //     'jenis_kelamin' => 'laki-laki',
            //     'tempat_lahir' => 'bogor',
            //     'tanggal_lahir' => date('1998-07-21'),
            //     'created_at' => date(now()),
            //     'updated_at' => date(now())
            // ],
        ]);
    }
}
