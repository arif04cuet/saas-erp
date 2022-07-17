<?php

namespace Modules\HRM\Console;

use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Repositories\LeaveRequestRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class NotifyRestAndRecreationLeaveRenewal extends Command
{
    private $leaveRequestRepository;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'notify:rest-and-recreational-leave-renewal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A notification sent to the employee about their leave renewal, its one week prior';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LeaveRequestRepository $leaveRequestRepository)
    {
        parent::__construct();
        $this->leaveRequestRepository = $leaveRequestRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $employees = Employee::with('employeePersonalInfo')->get()->each(function ($employee) {
            $employee->renewal_date = $this->getEmployeeLeaveRenewalDate($employee);
            return $employee;
        })->filter(function ($employee) {
            return $employee->renewal_date;
        });
        $employees->each(function ($employee) {
            $this->notifyEmployee($employee);
        });
    }

    /**
     * @param Employee $employee
     * @return \Carbon\Carbon|null
     */
    private function getEmployeeLeaveRenewalDate(Employee $employee)
    {
        $date = $this->leaveRequestRepository->getRestRecreationRenewalDate($employee);
        if (!is_null($date)) {
            return $date->format('Y-m-d');
        }
        return null;
    }

    private function notifyEmployee(Employee $employee)
    {
        if (!is_null($employee) && !is_null($employee->user)) {
            $notificationTypeName = 'REST_RECREATIONAL_LEAVE';
            $notificationType = NotificationType::firstOrCreate(['name'=>
                \App\Constants\NotificationType::getConstant($notificationTypeName)]);
            $user = $employee->user;
            $renewalDate = Carbon::parse($employee->renewal_date);
            $today = Carbon::today();
            if ($renewalDate->diffInDays($today) > 7) {
                return;
            }
            return Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => 10,
                'from_user_id' => $user->id,
                'to_user_id' => $user->id,
                'message' => 'Rest/Recreational Leave Will Renew At' . $renewalDate->format('Y-m-d'),
                'item_url' => "#"
            ]);
        }
    }
}
