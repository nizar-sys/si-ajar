<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_kelas')->insert([
            [
                'rombel' => 'RPL X - 1',
                'wali_kelas' => '2',
                'ketua_kelas' => '3',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
            [
                'rombel' => 'RPL X - 2',
                'wali_kelas' => '2',
                'ketua_kelas' => '4',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ],
            [
                'rombel' => 'RPL X - 3',
                'wali_kelas' => '2',
                'ketua_kelas' => '5',
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ]
        ]);
    }
}
