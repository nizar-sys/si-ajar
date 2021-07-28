<?php

namespace App\Jobs;

use App\Models\Ajar;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class JobUpdateStatusAjar implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // carbon
        $carbon = new Carbon;
        $jam = $carbon->format('H:i');
        $jam = strtotime($jam);

        $jadwalAjar = DB::table('tb_ajar')->get();

        // dd($jadwalAjar);
        foreach ($jadwalAjar as $jadwal) {
            $jam_selesai = strtotime($jadwal->jam_selesai);
            $jam_mulai = strtotime($jadwal->jam_mulai);
            $jadwal_id = $jadwal->id;

            if ($jam_selesai <= $jam) {
                DB::table('tb_ajar')->where('id', $jadwal_id)->update([
                    'status' => 'jadwal selesai',
                    'updated_at' => date(now())
                ]);
            } elseif ($jam_mulai >= $jam) {
                DB::table('tb_ajar')->where('id', $jadwal_id)->update([
                    'status' => 'jadwal sudah dimulai',
                    'updated_at' => date(now())
                ]);
            }
        }
    }
}
