<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\TMS\Emails\AnnualTrainingNotificationMail;
use Modules\TMS\Entities\AnnualTrainingNotification;
use Modules\TMS\Entities\AnnualTrainingNotificationOrganization;
use Modules\TMS\Repositories\AnnualTrainingNotificationOrganizationRepository;
use Modules\TMS\Repositories\AnnualTrainingNotificationRepository;
use Modules\TMS\Repositories\TrainingNotificationEmailRepository;
use phpDocumentor\Reflection\Types\Collection;

class AnnualTrainingNotificationService
{
    use CrudTrait;

    use FileTrait;
    /**
     * @var AnnualTrainingNotificationRepository
     */
    private $annualTrainingNotificationRepository;
    /**
     * @var AnnualTrainingNotificationOrganizationRepository
     */
    private $annualTrainingNotificationOrganizationRepository;
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;
    /**
     * @var TrainingNotificationEmailRepository
     */
    private $trainingNotificationEmailRepository;

    /**
     * AnnualTrainingNotificationService constructor.
     * @param AnnualTrainingNotificationRepository $annualTrainingNotificationRepository
     * @param AnnualTrainingNotificationOrganizationRepository $annualTrainingNotificationOrganizationRepository
     * @param EmployeeRepository $employeeRepository
     * @param TrainingNotificationEmailRepository $trainingNotificationEmailRepository
     */
    public function __construct(
        AnnualTrainingNotificationRepository $annualTrainingNotificationRepository,
        AnnualTrainingNotificationOrganizationRepository $annualTrainingNotificationOrganizationRepository,
        EmployeeRepository $employeeRepository,
        TrainingNotificationEmailRepository $trainingNotificationEmailRepository
    ) {
        $this->annualTrainingNotificationRepository = $annualTrainingNotificationRepository;
        $this->setActionRepository($annualTrainingNotificationRepository);
        $this->annualTrainingNotificationOrganizationRepository = $annualTrainingNotificationOrganizationRepository;
        $this->employeeRepository = $employeeRepository;
        $this->trainingNotificationEmailRepository = $trainingNotificationEmailRepository;
    }

    /**
     * Stores the notification with the organization values
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                if (!empty($data['attachment'])) {
                    $originalFileName = $data['attachment']->getClientOriginalName();
                    $path = $this->upload($data['attachment'], 'annual-training-notification');
                    $data['attachment'] = $path;
                    $data['attachment_file_name'] = $originalFileName;
                }
                $save = $this->save($data);

                $emailContent = $data['email_content'];
                $this->trainingNotificationEmailRepository->save([
                    'annual_training_notification_id' => $save->id,
                    'email_content' => $emailContent,
                    'created_at' => Carbon::parse()->format('Y-m-d h:i:s')
                ]);

                if ($save->send_to_divisional_director) {
                    $this->sendEmailToDds($save, $emailContent);
                }
                foreach ($data['organizations'] as $organization) {
                    $organizationData = [
                        'annual_training_notification_id' => $save->id,
                        'training_organization_id' => $organization,
                        'unique_key' => $this->generateUniqueKey(),
                        'last_date_of_response' => Carbon::parse()->addDay(7)->format('Y-m-d')
                    ];
                    $saveOrg = $this->annualTrainingNotificationOrganizationRepository->save($organizationData);
                    $this->sendEmailToOrganization($saveOrg, $emailContent);
                }
            });
            Session::flash('success', __('labels.save_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.save_fail') . ', ' . __('labels.error_code',
                    ['code' => $exception->getCode()]));
            Log::error($exception->getMessage() . " traceback: " . $exception->getTraceAsString());
            return false;
        }
    }

    /**
     * Generates unique key
     * @return string
     */
    public function generateUniqueKey()
    {
        return uniqid(Carbon::parse()->format('ymd-' . rand(10000, 99999) . '-'));
    }

    /**
     * Returns an array of years in fiscal format
     * @return array
     */
    public function getYears()
    {
        $years = [];
        for ($year = 2019; $year <= Carbon::parse()->format('Y'); $year++) {
            $yearString = $year . '-' . ($year + 1);
            $years[$yearString] = $yearString;
        }
        return ['' => __('labels.select')] + $years;
    }

    /**
     * @param AnnualTrainingNotificationOrganization $organization
     */
    public function sendEmailToOrganization(AnnualTrainingNotificationOrganization $organization, $emailContent)
    {
        $trainingOrganization = $organization->organization;
        $data = [
            'url' => route('annual-training-notification.response.organization.create', $organization->unique_key),
            'email_content' => $emailContent
        ];

        Mail::to($trainingOrganization->contact_person_email)->send(new AnnualTrainingNotificationMail($data));
    }

    /**
     * @param AnnualTrainingNotification $notification
     */
    public function sendEmailToDds(AnnualTrainingNotification $notification, $emailContent)
    {
        $divisionalDirectors = $this->getDivisionalDirectors();
        $lastDayOfResponse = Carbon::parse()->addDays(7)->format('d F, Y');
        foreach ($divisionalDirectors as $divisionalDirector) {
            $user = $divisionalDirector->user;
            $data = [
                'url' => route(
                    'tms.annual-training-notification.response.user.create',
                    [$notification->id, $user->id]
                ),
                'email_content' => $emailContent
            ];
            Mail::to($divisionalDirector->email)->send(new AnnualTrainingNotificationMail($data));
        }
    }

    /**
     * @return Collection
     */
    public function getDivisionalDirectors()
    {
        return $this->employeeRepository->getDivisionalDirectors();
    }
}

