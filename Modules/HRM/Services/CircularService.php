<?php


    namespace Modules\HRM\Services;

    use App\Constants\NotificationType as NotificationTypeConstant;
    use App\Entities\Notification\Notification;
    use App\Entities\Notification\NotificationType;
    use App\Entities\User;
    use App\Mail\WorkflowEmailNotification;
    use App\Services\UserService;
    use App\Traits\CrudTrait;
    use App\Traits\FileTrait;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use Modules\HRM\Entities\Circular;
    use Modules\HRM\Entities\CircularAttachment;
    use Modules\HRM\Entities\CircularRecipient;
    use Modules\HRM\Entities\Employee;
    use Modules\HRM\Repositories\CircularRepository;

    class CircularService
    {
        use CrudTrait;
        use FileTrait;

        private $circularRepository;
        private $userService;
        private $departmentService;
        private $employeeServices;

        public function __construct(
            CircularRepository $circularRepository,
            UserService $userService,
            DepartmentService $departmentService,
            EmployeeService $employeeServices
        )
        {
            $this->circularRepository = $circularRepository;
            $this->userService = $userService;
            $this->departmentService = $departmentService;
            $this->employeeServices = $employeeServices;
            $this->setActionRepository($circularRepository);
        }

        public function createViewPrepare()
        {
            $users = $this->userService->getUsersForDropdown(function ($user) {
                if (!is_null($user->employee)) {
                    return $user->employee->first_name
                        . ' '
                        . $user->employee->last_name
                        . ' - '
                        . optional($user->employee->designation)->name
                        . ' - '
                        . optional($user->employee->employeeDepartment)->name;
                }
            });

            $departments = $this->departmentService->getDepartmentsForDropdown();

            return compact('users', 'departments');
        }

        public function store(array $data)
        {
            return DB::transaction(function () use ($data) {
                $data['expiry_date'] = Carbon::createFromFormat("j F, Y", $data['expiry_date']);

                $recipients = [];

                if (isset($data['department'])) {
                    $employees = $this->employeeServices->findIn('department_id', $data['department']);
                    foreach ($employees as $employee) {
                        if($employee->user) {
                            array_push($recipients, $employee->user->id);
                        }
                    }
                }

                if (isset($data['recipient'])) {
                    $recipients = array_unique(
                        array_merge($recipients,
                            array_map(function($recipient) { return intval($recipient); },
                                $data['recipient']
                            )
                        )
                    );
                }

                $recipients = array_filter($recipients, function ($recipient) { return $recipient != auth()->user()->id; });

                $circular = $this->save($data);

                if (!empty($data['attachment'])){
                    $this->storeCircularAttachment($data, $circular);
                }

                if(in_array(Circular::PUBLIC_CIRCULAR, $recipients)) {

                    $users = User::all()->filter(function ($user) {
                        return $user->id != auth()->user()->id;
                    });

                    $limit = 0;
                    foreach ($users as $user) {
                        $circularRecipient = new CircularRecipient([
                            'recipient_id' => $user->id,
                        ]);

                        $circular->recipients()->save($circularRecipient);

                        if($limit < 5) {
                            $this->sendNotification($user->id, $circular);
                        }else {
                            $this->sendNotification($user->id, $circular, false);
                        }

                        $limit++;
                    }
                }else {
                    foreach ($recipients as $recipient) {
                        $circularRecipient = new CircularRecipient([
                            'recipient_id' => $recipient,
                        ]);

                        $circular->recipients()->save($circularRecipient);

                        $this->sendNotification($recipient, $circular);
                    }
                }

                return $circular;
            });
        }

        public function getAllCircularForCurrentUser()
        {
            $circulars = $this->circularRepository
                ->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc'])
                ->filter(function ($circular) {
                    $expiry_date = Carbon::parse($circular->expiry_date)->format('Y-m-d');

                    $isRecipient = $circular->recipients()
                        ->where('recipient_id', auth()->user()->id)
                        ->get()
                        ->first();

                    $isInitiator = $circular->initiator_id == auth()->user()->id;

                    if(($isRecipient || $isInitiator) && Carbon::parse($expiry_date)->greaterThanOrEqualTo(Carbon::today())) {
                        return true;
                    }

                    return false;
                });

            return $circulars;
        }

        public function getAllPublicCirculars()
        {
            $circulars = $this->circularRepository
                ->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc'])
                ->filter(function ($circular) {
                    $expiryDate = Carbon::parse($circular->expiry_date);

                    $isPublicRecipient = ((User::all()->count() - 1) <= $circular->recipients()->count()) ? true : false;

                    if($isPublicRecipient && $expiryDate->greaterThanOrEqualTo(Carbon::today())) {
                        return true;
                    }

                    return false;
                });

            return $circulars;
        }

        private function storeCircularAttachment($data, $circular)
        {
            $file = $data['attachment'];
            $fileName = $file->getClientOriginalName();
            $filePath = $this->upload($file, "circular-files/{$circular->id}");

            $circularAttachment = new CircularAttachment([
                'file_name' => $fileName,
                'file_path' => $filePath

            ]);
            $circular->attachment()->save($circularAttachment);
        }

        private function sendNotification($recipient, $circular, $sendEmail = true)
        {
            $notificationType = NotificationType::where('name', NotificationTypeConstant::HRM_CIRCULAR)->firstOrFail();

            $user = User::find($recipient);

            if($user) {
                $notification = Notification::create([
                    'type_id' => $notificationType->id,
                    'ref_table_id' => $circular->id,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $user->id,
                    'message' => $circular->title,
                    'item_url' => route('circular.show', $circular->id)
                ]);

                if($sendEmail) {
                    $this->sendEmail($user, $notification, $circular);
                }
            }
        }

        private function sendEmail($recipient, $notification, $circular)
        {

            Mail::to($recipient)->send(
                new WorkflowEmailNotification(
                    'HRM CIRCULAR',
                    $notification->message,
                    route('circular.show', $circular->id)
                )
            );
        }
    }
