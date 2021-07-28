<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_mapel')->insert([
            [
                'nama_mapel' => 'Bahasa inggris',
                'created_at'=>date(now()),
                'updated_at'=>date(now()),
            ],
            [
                'nama_mapel' => 'Bahasa sunda',
                'created_at'=>date(now()),
                'updated_at'=>date(now()),
            ],
            [
                'nama_mapel' => 'PPKN',
                'created_at'=>date(now()),
                'updated_at'=>date(now()),
            ],
            [
                'nama_mapel' => 'Produktif',
                'created_at'=>date(now()),
                'updated_at'=>date(now()),
            ],
        ]);
    }
}
