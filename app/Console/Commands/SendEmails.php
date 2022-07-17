<?php

namespace App\Console\Commands;

use App\Mail\WorkflowEmailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\MailNotification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pending mail notification to employees';

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
     * @return mixed
     */
    public function handle()
    {
        $notifications = MailNotification::where('status', 'pending')
            ->take(env('MAIL_PER_COMMAND', 5))
            ->get();

        $notifications->each(function ($notification) {
            Mail::to($notification->email)
                ->send(
                    new WorkflowEmailNotification(
                        $notification->title,
                        $notification->message,
                        $notification->item_url
                    )
                );
        });

        $unreachedRecipients = Mail::failures();
        $reachedRecipients = $notifications->map(function ($notification) {
            return $notification->email;
        })->diff($unreachedRecipients)->toArray();


        foreach ($notifications as $notification) {
            $email = $notification->email;
            if (in_array($email, $reachedRecipients)) {
                $notification->update(['status' => 'sent']);
            }
            if (in_array($email, $unreachedRecipients)) {
                $notification->update(['status' => 'failed']);
            }
        }

        $this->info(
            "Recipients reached: " . implode(', ', $reachedRecipients) . " \n" .
            "Recipients unreached: " . implode(', ', $unreachedRecipients)
        );
        Log::info(
            "Recipients reached: " . implode(', ', $reachedRecipients) . " \n" .
            "Recipients unreached: " . implode(', ', $unreachedRecipients)
        );
    }
}
