<?php

namespace App\Console;

use App\Jobs\JobUpdateStatusAjar;
use App\Jobs\SendNotifJob;
use App\Mail\NotifJadwalBelajar;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->everyMinute();
        $now = Carbon::now();

        $schedule->job(new SendNotifJob)->daily()->timezone('Asia/Jakarta')->at('07:30');
        $schedule->job(new JobUpdateStatusAjar)->daily()->timezone('Asia/Jakarta')->at('07:30');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
