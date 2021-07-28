<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AjarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_ajar')->insert([
            [
                'tanggal'=>date('Y-m-d'),
                'jam_mulai'=>'13:00',
                'jam_selesai'=>'10:00',
                'pengajar_id'=>'2',
                'mapel_id'=>'1',
                'rombel_id'=>'1',
                'status'=>' '
            ],
            [
                'tanggal'=>date('Y-m-d'),
                'jam_mulai'=>'13:00',
                'jam_selesai'=>'16:00',
                'pengajar_id'=>'2',
                'mapel_id'=>'1',
                'rombel_id'=>'1',
                'status'=>' '
            ],
            [
                'tanggal'=>date('Y-m-d'),
                'jam_mulai'=>'13:00',
                'jam_selesai'=>'16:00',
                'pengajar_id'=>'2',
                'mapel_id'=>'1',
                'rombel_id'=>'1',
                'status'=>' '
            ],
            [
                'tanggal'=>date('Y-m-d'),
                'jam_mulai'=>'13:00',
                'jam_selesai'=>'16:00',
                'pengajar_id'=>'2',
                'mapel_id'=>'1',
                'rombel_id'=>'1',
                'status'=>' '
            ],
            [
                'tanggal'=>date('Y-m-d'),
                'jam_mulai'=>'13:00',
                'jam_selesai'=>'10:00',
                'pengajar_id'=>'2',
                'mapel_id'=>'1',
                'rombel_id'=>'1',
                'status'=>' '
            ],
        ]);
    }
}
