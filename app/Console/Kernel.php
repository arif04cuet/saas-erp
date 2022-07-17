<?php

namespace App\Console;

use App\Console\Commands\SendEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Modules\HRM\Console\NotifyRestAndRecreationLeaveRenewal;
use Modules\Publication\Console\NotifyResearcherBeforeDeadlineTest;
use Modules\TMS\Console\RejectExpiredBookingRequest;
use Modules\TMS\Console\SendScheduledSessionNotificationToCourseAdministration;
use Modules\TMS\Console\SendScheduledSessionNotificationToSpeakerEmail;
use Modules\TMS\Console\SendScheduledSessionNotificationToTraineeEmail;
use Modules\TMS\Console\SendTraineeListToCourseAdministration;
use Modules\TMS\Console\SendWarningNotificationToTraineeEmail;
use Modules\TMS\Emails\ScheduledSessionSpeakerEmail;
use Modules\TMS\Emails\ScheduledSessionTraineeEmail;
use Modules\VMS\Console\ReleaseExpiredTripVehicles;

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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(SendEmails::class)
            ->withoutOverlapping()->everyMinute();


        $configurations = config('training.course.module.session.schedule.email');

        // Speaker Schedule Email
        $schedule->command(SendScheduledSessionNotificationToSpeakerEmail::class)
            ->dailyAt($configurations['speaker_email']['duration']['start'])
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // Course Admin Schedule Email
        $schedule->command(SendScheduledSessionNotificationToCourseAdministration::class)
            ->dailyAt($configurations['course_administration_email']['duration']['start'])
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // Trainee Schedule Email
        $schedule->command(SendScheduledSessionNotificationToTraineeEmail::class)
            ->everyFiveMinutes()
            ->timezone('Asia/Dhaka')
            ->between(
                $configurations['trainee_email']['duration']['start'],
                $configurations['trainee_email']['duration']['end']
            )
            ->withoutOverlapping();

        // Trainee Evaluation Warning Email Notification - Collect all recipients
        $schedule->command(SendWarningNotificationToTraineeEmail::class, [true])
            ->hourlyAt(
                $configurations['trainee_evaluation_warning']['fetch_recipients']['hourly_at']
            )
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // Trainee Evaluation Warning Email Notification - Send Email Notification
        $schedule->command(SendWarningNotificationToTraineeEmail::class)
            ->everyFiveMinutes()
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // Course Administration Email Notification for Trainees list - who didn't evaluated
        $schedule->command(SendTraineeListToCourseAdministration::class)
            ->dailyAt(
                $configurations['trainee_list']['did_not_evaluated']['daily_at']
            )
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // command to reject expired physical facility booking request
        $schedule->command(\App\Console\Commands\RejectExpiredBookingRequest::class)
            ->daily()
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // command to notify rest and recreational leave renewal
        $schedule->command(NotifyRestAndRecreationLeaveRenewal::class)
            ->weekly()
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        // command to notify rest and recreational leave renewal
        $schedule->command(ReleaseExpiredTripVehicles::class)
            ->daily()
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();

        $schedule->command(NotifyResearcherBeforeDeadline::class)
            ->daily()
            ->timezone('Asia/Dhaka')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
