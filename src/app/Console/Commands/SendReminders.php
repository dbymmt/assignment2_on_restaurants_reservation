<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Notifications\ReminderNotification;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendReminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $today_reservations = Reservation::where('scheduled_date', $today)->get();

        foreach ($today_reservations as $today_reservation) {
            $today_reservation->user->notify(new ReminderNotification($today_reservation->user, $today_reservation));
        }

        Log::info('test_from_scheduled_Commands');
        // return 0;
    }
}
