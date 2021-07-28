<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new Carbon;
        DB::table('tb_absensi')->insert([
            'jadwal_id' => '9',
            'jam_absen' => $carbon->format('h:i'),
            'keterangan' => 'masuk',
        ]);
    }
}
