<?php

namespace App\Jobs;

use App\Entities\Notification\Notification;

use App\Entities\Notification\NotificationType;
use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Accounts\Exports\Payroll\PayslipBatchExport;
use Modules\Accounts\Http\Controllers\PayslipReportController;
use Modules\HRM\Entities\Employee;

class PayrollReportExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $compact;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param $compact
     */
    public function __construct(User $user, $compact)
    {
        $this->user = $user;
        $this->compact = $compact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::store(new PayslipBatchExport($this->compact), PayslipReportController::REPORT_PATH, 'excel-export');
        return $this->sendNotification();
    }

    private function sendNotification()
    {
        $notificationTypeName = 'EXCEL_EXPORT_FINISHED';
        $notificationType = NotificationType::where('name', \App\Constants\NotificationType::getConstant($notificationTypeName))->firstOrFail();
        return Notification::create([
            'type_id' => $notificationType->id,
            'ref_table_id' => 10,
            'from_user_id' => $this->user->id,
            'to_user_id' => $this->user->id,
            'message' => 'Export is finished, click to download',
            'item_url' => $this->compact['baseUrl']
        ]);
    }

    public function failed(\Exception $e = null)
    {
        Log::error('Report Export Error ' . $e->getMessage());
        $notificationTypeName = 'EXCEL_EXPORT_FINISHED';
        $notificationType = NotificationType::where('name', \App\Constants\NotificationType::getConstant($notificationTypeName))->firstOrFail();
        return Notification::create([
            'type_id' => $notificationType->id,
            'ref_table_id' => 10,
            'from_user_id' => $this->user->id,
            'to_user_id' => $this->user->id,
            'message' => 'Report Export Failed !',
            'item_url' => '#'
        ]);
    }
}
