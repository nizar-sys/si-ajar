<?php

namespace App\Jobs;

use App\Mail\MyTestMail;
use App\Mail\NotifJadwalBelajar;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotifJob implements ShouldQueue
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
        $siswa = Student::all();

        for ($i = 0; $i < count($siswa); $i++) {
            $details = [
                'title' => 'Jadwal KBM Akan Dimulai',
                'body' => 'Jangan lupa absensi ya',
            ];
            Mail::to($siswa[$i]->user->email)->send(new NotifJadwalBelajar($details));
        }
    }
}
