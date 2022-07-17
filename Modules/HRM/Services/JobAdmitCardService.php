<?php

namespace Modules\HRM\Services;

use App\Mail\ShortListedApplicantMail;
use App\Services\JobApplicationService;
use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use App\Utilities\MonthNameConverter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Repositories\DepartmentRepository;
use Modules\HRM\Repositories\JobAdmitCardRepository;
use PhpOffice\PhpWord\TemplateProcessor;

class JobAdmitCardService
{
    use CrudTrait;
    /**
     * @var JobAdmitCardRepository
     */
    private $jobAdmitCardRepository;
    /**
     * @var JobCircularService
     */
    private $jobCircularService;
    /**
     * @var JobApplicationService
     */
    private $jobApplicationService;
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * JobAdmitCardService constructor.
     * @param JobAdmitCardRepository $jobAdmitCardRepository
     * @param JobCircularService $jobCircularService
     * @param JobApplicationService $jobApplicationService
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        JobAdmitCardRepository $jobAdmitCardRepository,
        JobCircularService $jobCircularService,
        JobApplicationService $jobApplicationService,
        DepartmentRepository $departmentRepository
    ) {
        $this->jobAdmitCardRepository = $jobAdmitCardRepository;
        $this->setActionRepository($jobAdmitCardRepository);
        $this->jobCircularService = $jobCircularService;
        $this->jobApplicationService = $jobApplicationService;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param array $data
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            $data['date_of_exam'] = Carbon::parse($data['time_of_exam'] . ' ' . $data['date_of_exam'])
                ->format('Y-m-d H:i:s');
            $saved = $this->save($data);
            $this->emailToShortlisted($saved->id);
            return $saved;
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param $id
     */
    public function emailToShortlisted($id)
    {
        $admitCard = $this->findOne($id);
        $jobCircular = $admitCard->circular;
        if ($jobCircular) {
            $shortlistedApplications = $jobCircular->shortlistedJobApplications->pluck('email');
            $to = Auth::user()->email;
            Mail::to($to)->bcc($shortlistedApplications)->send(new ShortListedApplicantMail($jobCircular,
                $admitCard->id));
        }
    }

    /**
     * @param $applicantId
     * @param $mobile
     * @param $jobCircularId
     * @return array
     */
    public function generateAdmitDownloadLink($applicantId, $mobile, $admitCardId)
    {
        $admitCard = $this->findOne($admitCardId);
        $jobCircular = $admitCard->circular;
        $jobCircularId = $jobCircular->id;
        $applicant = $this->jobApplicationService->findBy([
            'applicant_id' => $applicantId,
            'mobile' => $mobile,
            'circular_no' => $jobCircularId
        ])->first();

        if ($applicant) {
            return [
                route('job-admit-cards.download-file', [
                    'admitCardId' => $admitCardId,
                    'applicantId' => $applicant->applicant_id,
                    'hash' => md5($applicant->applicant_id)
                ]),
                $applicant,
                $jobCircular
            ];
        } else {
            return [null, null, null];
        }
    }

    public function generateAdmitFile($data)
    {
        $template = storage_path() . '/files/templates/InterviewCard.docx';
        $templateProcessor = new TemplateProcessor($template);

        $templateValues = $this->prepareAdmitCardValues($data);
        foreach ($templateValues as $key => $templateValue) {
            $templateProcessor->setValue($key, $templateValue);
        }

        $fileName = storage_path() . '/files/temps/admit_card_' . $data[1] . '.docx';
        $templateProcessor->saveAs($fileName);

        return $fileName;
    }

    private function prepareAdmitCardValues($data)
    {
        $admitCard = $this->findOne($data[0]);
        $circular = $admitCard->circular;
        $applicant = $this->jobApplicationService->findBy(['applicant_id' => $data[1]])->first();

        $examDate = $admitCard->date_of_exam;
        $examTimeArr = explode(':', Carbon::parse($examDate)->format('h:i'));
        $examTime = EnToBnNumberConverter::en2bn($examTimeArr[0]) . ':' . EnToBnNumberConverter::en2bn($examTimeArr[1]);
        $permanentAddress = $applicant->permanentAddress;
        $dirAdmin = $this->departmentRepository->findBy(['department_code' => 'ADMIN'])->first()->head;

        return [
            'publishDate' => MonthNameConverter::convertMonthToBn($admitCard->created_at, false, true),
            'post' => optional($circular->designation)->getName() ?? $circular->title,
            'type' => __('hrm::job-circular.admit_card.exam_types.' . $admitCard->exam_type),
            'date' => MonthNameConverter::convertMonthToBn($examDate, false, true),
            'time' => MonthNameConverter::convertDayToBn($examDate, false) . ', ' . $examTime,
            'center' => $admitCard->exam_center,
            'location' => $admitCard->location,
            'applicantName' => $applicant->applicant_name_bn,
            'motherName' => $applicant->mother_name,
            'fatherName' => $applicant->father_name,
            'roadAndHouse' => $permanentAddress->road_and_house,
            'postOffice' => $permanentAddress->post_office,
            'subDistrict' => $permanentAddress->sub_district,
            'district' => $permanentAddress->district,
            'roll' => $applicant->applicant_id,
            'directorAdmin' => $dirAdmin ? $dirAdmin->getName() : ' - '
        ];
    }

}

