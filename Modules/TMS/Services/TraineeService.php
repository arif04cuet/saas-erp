<?php

/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 12/24/18
 * Time: 7:24 PM
 */

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\HM\Entities\CheckinTrainee;
use Modules\HM\Services\CheckinTraineeService;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\TraineeCourseMarkValue;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\CourseEvaluationSubmissionRepository;
use Modules\TMS\Repositories\TraineeRepository;
use Modules\TMS\Repositories\TrainingCourseRepository;
use Modules\TMS\Repositories\TrainingRepository;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Closure;

class TraineeService
{
    use CrudTrait;
    use FileTrait;

    private $traineeRepository, $trainingRepository;
    private $trainingCourseRepository;
    private $courseEvaluationSubmissionRepository;
    private $checkinTraineeService;

    public function __construct(
        TraineeRepository $traineeRepository,
        TrainingRepository $trainingRepository,
        TrainingCourseRepository $trainingCourseRepository,
        CheckinTraineeService $checkinTraineeService,
        CourseEvaluationSubmissionRepository $courseEvaluationSubmissionRepository
    ) {
        $this->traineeRepository = $traineeRepository;
        $this->trainingRepository = $trainingRepository;
        $this->trainingCourseRepository = $trainingCourseRepository;
        $this->checkinTraineeService = $checkinTraineeService;
        $this->courseEvaluationSubmissionRepository = $courseEvaluationSubmissionRepository;

        $this->setActionRepository($traineeRepository);
    }

    public function fetchTraineesWithID($trainingId)
    {
        // return $this->traineeRepository->getTraineesByTraining($trainingId);
        return $this->traineeRepository->getTraineesByTrainingTest($trainingId);
    }
    public function fetchTraineesID()
    {
        return $traineeIds = Trainee::where('status', null)->orWhere('status', '')
            ->orWhere('register_to_online', '=', 'online')->get();
    }

    public function importCSV(Request $data, $unsetEmptyCells = false)
    {
        $extension = $data->file('import_file')->getClientOriginalExtension();

        if ('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new Xlsx();
        }
        $spreadsheet = $reader->load($data->file('import_file')->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $highestRowAndColumn = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray(
            'A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'],
            null,
            false,
            true,
            false
        );
        if ($unsetEmptyCells) {
            // ignoring the empty cells
            foreach ($sheetData as $key => &$row) {
                $row = array_filter(
                    $row,
                    function ($cell) {
                        return !is_null($cell);
                    }
                );
                if (count($row) == 0) {
                    unset($sheetData[$key]);
                }
            }
        }
        return $sheetData;
    }

    public function validateTraineeList(int $trainingId, array $trainees)
    {

        list(
            $existingTraineesMobileNumbers,
            $importedTraineesMobileNumbers
        ) = $this->getImportedAndExistingTraineesMobileNumbers(
            $trainingId,
            $trainees
        );

        list(
            $existingTraineesEmails,
            $importedTraineesEmails
        ) = $this->getImportedAndExistingTraineesEmailId($trainingId, $trainees);


        // dd( $existingTraineesEmails,$importedTraineesEmails);

        $errors = array();

        foreach ($trainees as $key => $trainee) {

            list(
                $firstName,
                $lastName,
                $gender,
                $mobileNo,

                $bangla_full_name,
                $english_full_name,
                $dob,
                $email,
                $badge_name,
                $badge_name_bn,
            ) = $trainee;

            // remove current trainee mobile number from the list
            $traineesMobileNumbers = array_filter($importedTraineesMobileNumbers, function ($traineeKey) use ($key) {
                return $traineeKey !== $key;
            }, ARRAY_FILTER_USE_KEY);


            // remove current trainee EmailID from the list
            $traineesMobileEmails = array_filter($importedTraineesEmails, function ($traineeKey) use ($key) {
                return $traineeKey !== $key;
            }, ARRAY_FILTER_USE_KEY);

            // dd($traineesMobileEmails);

            if (
                $this->hasInvalidName($firstName, $lastName) ||
                $this->hasInvalidName($bangla_full_name, $english_full_name) ||
                $this->hasInvalidName($badge_name, $badge_name_bn) ||
                $this->hasInvalidGender($gender) ||
                $this->hasInvalidOrNotUniqueMobileNo(
                    $mobileNo,
                    $traineesMobileNumbers,
                    $existingTraineesMobileNumbers
                ) ||
                $this->hasInvalidOrNotUniqueEmail($email, $traineesMobileEmails, $existingTraineesEmails)
            ) {
                $errors[] = $key;
            }
        }

        return $errors;
    }

    public function getTraineeCount($trainingId)
    {
        $traineeNo = $this->traineeRepository->fetchAssignedTraineeNo($trainingId);

        return $traineeNo;
    }

    /**
     * @param $firstName
     * @param $lastName
     * @return bool
     */
    private function hasInvalidName($firstName, $lastName): bool
    {
        if ($firstName == "" || $lastName == "") {
            return true;
        }
        return false;
    }

    /**
     * @param $gender
     * @return bool
     */
    private function hasInvalidGender($gender): bool
    {
        if (!in_array(ucwords($gender), array('Male', 'Female', 'Others'))) {
            return true;
        }
        return false;
    }

    /**
     * @param $mobileNo
     * @param array $importedTraineeMobileNumbers
     * @param array $existingTraineesMobileNumbers
     * @return bool
     */
    private function hasInvalidOrNotUniqueMobileNo(
        $mobileNo,
        array $importedTraineeMobileNumbers,
        array $existingTraineesMobileNumbers
    ): bool {
        $mobileNoLength = strlen($mobileNo);
        $mobileOperatorNumber = substr($mobileNo, 0, 3);

        if (!in_array(
            $mobileOperatorNumber,
            array('017', '013', '014', '015', '016', '018', '019')
        ) || $mobileNoLength != 11) {
            return true;
        }

        // check not unique mobile number
        if (in_array($mobileNo, $importedTraineeMobileNumbers) || in_array($mobileNo, $existingTraineesMobileNumbers)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $trainingId
     * @param array $trainees
     * @return array
     */
    private function getImportedAndExistingTraineesMobileNumbers(int $trainingId, array $trainees): array
    {
        $existingTraineesMobileNumbers = $this->traineeRepository->findBy(['training_id' => $trainingId])
            ->pluck('mobile')
            ->toArray();

        // mobile numbers of trainees
        $importedTraineesMobileNumbers = array_map(function ($trainee) {
            return $trainee[4];
        }, $trainees);

        // arrays are not merged to persist key which is used later to filter mobile numbers
        return array($existingTraineesMobileNumbers, $importedTraineesMobileNumbers);
    }


    /**
     * @param $emailID
     * @param array $importedTraineeEmails
     * @param array $existingTraineesEmails
     * @return bool
     */
    private function hasInvalidOrNotUniqueEmail(
        $emailID,
        array $importedTraineeEmails,
        array $existingTraineesEmails
    ): bool {

        if (!filter_var($emailID, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        // check not unique mobile number
        if (in_array($emailID, $importedTraineeEmails) || in_array($emailID, $existingTraineesEmails)) {
            return true;
        }

        return false;
    }


    /**
     * @param int $trainingId
     * @param array $trainees
     * @return array
     */
    private function getImportedAndExistingTraineesEmailId(int $trainingId, array $trainees): array
    {
        $existingTraineesEmail = $this->traineeRepository->findBy(['training_id' => $trainingId])
            ->pluck('email')
            ->toArray();

        // email id of trainees
        $importedTraineesEmail = array_map(function ($trainee) {
            return $trainee[3];
        }, $trainees);

        // arrays are not merged to persist key which is used later to filter mobile numbers
        return array($existingTraineesEmail, $importedTraineesEmail);
    }


    public function getTraineeTrainingInfoByMobileNo(string $mobileNo)
    {
        return $this->findBy(['mobile' => $mobileNo])->map(function ($trainee) {
            return (object)[
                'trainee_id' => $trainee->id,
                'training_id' => $trainee->training_id,
                'training_name' => $trainee->training->training_title,
                'start_date' => $trainee->training->start_date,
                'end_date' => $trainee->training->end_date,
            ];
        });
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return mixed
     */
    public function getAllTraineesAchievedMarks(Training $training, TrainingCourse $course)
    {
        $traineesWithMarks = $training->trainee->map(function ($trainee) use ($course, $training) {

            $achievedMarks = $this->getTraineeAchievedMarks($trainee, $course);
            $shouldShowCertificateLink = $this->shouldShowCertificateLink($achievedMarks);
            $certificationLink = $this->getCertificateLink($training, $course, $trainee);

            return (object)[
                'id' => $trainee->id,
                'full_name' => $trainee[trans('tms::trainee.name_locale')],
                'achieved_marks' => $achievedMarks,
                'should_show_certificate_link' => $shouldShowCertificateLink,
                'certificate_link' => $certificationLink
            ];
        });
        return $traineesWithMarks;
    }
    public function getTraineeAchievedMarkDetails(TrainingCourse $course, Trainee $trainee)
    {
        $achievedMarks = $course->markAllotments->map(function ($markAllotment) use ($trainee, $course) {
            // TODO: use TraineeCourseMarkValueService to retrieve achieved course mark
            $courseMarkValue = TraineeCourseMarkValue::where('trainee_id', $trainee->id)
                ->where('training_course_id', $course->id)
                ->where('training_course_mark_allotment_type_id', optional($markAllotment->type)->id)
                ->first();

            return (object)[
                'mark_allotment_type_id' => $markAllotment->type->id,
                'full_name' => $trainee[trans('tms::trainee.name_locale')],
                'value' => is_null($courseMarkValue) ? null : $courseMarkValue->value
            ];
        });
        return $achievedMarks;
    }

    private function shouldShowCertificateLink($achievedMarks)
    {
        $shouldShowCertificate = true;
        foreach ($achievedMarks as $achievedMark) {
            if (is_null(optional($achievedMark)->value)) { {
                    $shouldShowCertificate = false;
                }
            }
        }
        return $shouldShowCertificate;
    }

    /**
     *
     * if the level is international, show international certificate (international)
     * if the level is national, see lang preference,
     * if langPref is bangla - show bangla version (bn2) //bn is the old version
     * if langPref is english - show english version (en)
     * if langPref is both - show english version (en)
     * @param Training $training
     * @param TrainingCourse $trainingCourse
     * @param Trainee $trainee
     * @param string $type
     * @return string
     */
    private function getCertificateLink(
        Training $training,
        TrainingCourse $trainingCourse,
        Trainee $trainee,
        $type = 'en'
    ): string {
        $level = '';
        $trainingLangPreference = Training::getLangPreferences();
        $trainingHead = $training->trainingHead;
        if (!is_null($trainingHead)) {
            $level = $trainingHead->level ?? 'national';
        }

        if ($level == 'international') {
            $type = 'international';
        } else {
            // for national traininig
            $langPreference = $training->lang_preference;
            $langPreference == $trainingLangPreference['only_bangla'] ? $type = 'bn2' : $type = 'en';
        }
        return route('trainees.certificates.show', [$trainee->id, $trainingCourse->id, $type]);
    }

    /**
     * @param $trainee
     * @param $course
     * @return mixed
     */
    public function getTraineeAchievedMarks($trainee, $course)
    {
        $achievedMarks = $course->markAllotments->map(function ($markAllotment) use ($trainee, $course) {
            // TODO: use TraineeCourseMarkValueService to retrieve achieved course mark
            $courseMarkValue = TraineeCourseMarkValue::where('trainee_id', $trainee->id)
                ->where('training_course_id', $course->id)
                ->where('training_course_mark_allotment_type_id', optional($markAllotment->type)->id)
                ->first();

            return (object)[
                'mark_allotment_type_id' => $markAllotment->type->id,
                'value' => is_null($courseMarkValue) ? null : $courseMarkValue->value
            ];
        });
        return $achievedMarks;
    }

    public function storeTrainee(Training $training, array $data)
    {
        return DB::transaction(function () use ($training, $data) {
            if (array_key_exists('photo', $data)) {
                $file = $data['photo'];
                $path = $this->upload($file, 'registered-trainees');
                $data['photo'] = $path;
            }

            if (array_key_exists('dob', $data)) {
                $data['dob'] = Carbon::createFromFormat('d/m/Y', $data['dob']);
            }

            if (array_key_exists('joining_date', $data)) {
                $data['joining_date'] = Carbon::createFromFormat('d/m/Y', $data['joining_date']);
            }

            if (array_key_exists('mobile', $data)) {
                $data['mobile'] = bn2enNumber($data['mobile']);
            }

            $trainee = $this->save($data);

            return $trainee;
        });
    }

    public function updateTrainee(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data) {

            if (array_key_exists('photo', $data)) {
                $file = $data['photo'];
                $path = $this->upload($file, 'registered-trainees');
                $data['photo'] = $path;
            }

            if (array_key_exists('dob', $data)) {
                $data['dob'] = Carbon::createFromFormat('d/m/Y', $data['dob']);
            }

            if (array_key_exists('mobile', $data)) {
                $data['mobile'] = bn2enNumber($data['mobile']);
            }

            return $this->update($trainee, $data);
        });
    }

    public function banglaNumber($int)
    {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
        $converted = str_replace($engNumber, $bangNumber, $int);
        return $converted;
    }

    public function courses(Trainee $trainee)
    {
        //$training = null;

        return $courses = $this->traineeRepository->findBy([
            'id' => $trainee->id
        ])->map(function ($trainee) {
            return $trainee->trainings;
        })->flatten()
            ->map(function ($training) {
                return $training->courses;
            })->flatten()
            ->map(function ($course) {
                return (object)[
                    'training_name' => optional($course->training)->title,
                    'course_id' => $course->id,
                    'course_name' => $course->name,
                    'start_date' => $course->start_date,
                    'end_date' => $course->end_date,
                ];
            });
    }

    public function coursesWithEvaluationSettings($mobileNo = "")
    {
        $trainingIds = $this->traineeRepository->findBy([
            'mobile' => $mobileNo
        ])->mapWithKeys(function ($trainee) {
            return [$trainee->id => $trainee->training->id];
        })->toArray();
        $courses = collect();

        $today = Carbon::today('Asia/Dhaka');

        if (!empty($trainingIds)) {
            $courses = $this->trainingCourseRepository->findIn(
                'training_id',
                $trainingIds,
                'evaluationSetting'
            )->filter(function ($course) use ($today, $trainingIds) {
                $status = optional($course->evaluationSetting)->status;

                $trainee = array_search($course->training->id, $trainingIds);
                $submission = $this->courseEvaluationSubmissionRepository
                    ->findBy([
                        'training_course_id' => $course->id,
                        'trainee_id' => $trainee
                    ])->first();

                if ($submission) {
                    return false;
                }
                if ($status) {
                    $startDate = Carbon::parse($course->evaluationSetting->start_date);
                    $endDate = Carbon::parse($course->evaluationSetting->end_date);
                    return ($today->greaterThanOrEqualTo($startDate) && $today->lessThanOrEqualTo($endDate));
                }

                return false;
            })->map(function ($course) use ($trainingIds) {
                $trainee = array_search($course->training->id, $trainingIds);
                return (object)[
                    'training_name' => optional($course->training)->title,
                    'course_id' => $course->id,
                    'course_name' => $course->name,
                    'start_date' => Carbon::parse($course->start_date)->format('j F, Y'),
                    'end_date' => Carbon::parse($course->end_date)->format('j F, Y'),
                    'deadline' => Carbon::parse($course->evaluationSetting->end_date)->format('j F, Y'),
                    'evaluation_url' => route('public.courses.evaluations.create', [
                        'course' => $course,
                        'trainee' => $trainee
                    ])
                ];
            });
        }
        // dd($courses);
        return $courses;
    }

    /**
     * @param $trainees
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getTraineesForDropdown(
        $trainees,
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        if (is_null($trainees)) {
            $trainees = $query
                ? $this->actionRepository->findBy($query)
                : $this->actionRepository->findAll();
        }
        $lang = app()->getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $trainees,
            $implementedKey,
            $implementedValue ?: function ($trainee) use ($lang) {
                $name = $lang == 'bn' ? $trainee->bangla_name : $trainee->english_name;
                return $trainee->mobile . ' - ' . $name;
            },
            $isEmptyOption
        );
    }

    /**
     * Prepare trainee data for 'booking_guest_info' table
     * @param $roomBookingId
     * @param $trainingId
     * @param $traineeId
     * @return array
     */
    public function prepareTraineeDataForHostelCheckIn($roomBookingId, $trainingId, $traineeId): array
    {
        $data = [];
        $data['room_booking_id'] = $roomBookingId;
        $trainee = $this->findBy(['training_id' => $trainingId, 'id' => $traineeId])->first();
        $values = explode(' ', $trainee->bangla_name);
        $data['first_name'] = $values[0] ?? '';
        $data['last_name'] = $values[1] ?? '';
        $data['age'] = Carbon::now()->diffInYears($trainee->dob);
        $data['gender'] = $trainee->trainee_gender;
        $data['relation'] = 'trainee';
        $data['mobile_number'] = $trainee->mobile;
        $data['nid_no'] = null;
        $data['nid_doc'] = null;
        $data['status'] = 'checkin';
        $data['nationality'] = 'Bangladeshi';
        $data['address'] = optional($trainee->generalInfos)->present_address ?? '';
        return $data;
    }

    /**
     * @param array $trainees
     * @return array
     */
    public function convertDropdownToSelect2Format(array $trainees)
    {
        $eachTrainee = collect();
        foreach ($trainees as $key => $value) {
            $newCollect = collect();
            $newCollect['id'] = $key;
            $newCollect['text'] = $value;
            $eachTrainee[] = $newCollect;
        }
        return $eachTrainee->toArray();
    }

    /**
     * Get the trainees of who didnt checked in yet in hostel
     * @param Training $training
     * @param bool $reverse - pass true for opposite result
     * @return
     */
    public function filterTraineesByHostelCheckIn(Training $training, $reverse = false)
    {
        $checkedInTraineesId = $this->checkinTraineeService->getCheckedInTrainees($training);
        //todo:: move this to repository
        return $this->actionRepository->getModel()
            ->newQuery()->where('training_id', $training->id)
            ->whereNotIn('id', $checkedInTraineesId)
            ->get();
    }

    /**
     * @param string $mobileNumber
     * @param Training $training
     * @return mixed
     */
    public function getRegisteredTraineeOfTraining(string $mobileNumber, Training $training)
    {
        return $this->actionRepository->getRegisteredTraineeOfTraining($mobileNumber, $training);
    }

    public function getTraineeInformation($trainingId)
    {
        return $this->traineeRepository->findOrFail($trainingId);
    }

    public function approveOnlineEnrollTrainee(Trainee $trainee)
    {
        return DB::transaction(function () use ($trainee) {
            $data['status'] = 1;
            return $this->update($trainee, $data);
        });
    }
    public function rejectOnlineEnrollTrainee(Trainee $trainee)
    {
        return DB::transaction(function () use ($trainee) {
            $data['status'] = 2;
            return $this->update($trainee, $data);
        });
    }
}
