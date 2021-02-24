<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *Go to your terminal, ssh into your server, cd into your project and run this command.

* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
     * @var array
     */
    /*
crontab -e
This will open the server Crontab file, paste the code below into the file, save and then exit.

1

    */
    protected $commands = [
        //
        Commands\MinuteUpdate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('send:reminder')->cron('0 0 */3 * *'); //This runs the command every three days
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
