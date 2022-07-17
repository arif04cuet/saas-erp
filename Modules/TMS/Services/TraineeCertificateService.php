<?php

namespace Modules\TMS\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use FontLib\Table\Type\loca;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;

class TraineeCertificateService
{

    const COURSE_NAME_FIRST_LINE_MAX_CHAR_LIMIT = 62;
    const COURSE_NAME_SECOND_LINE_MAX_CHAR_LIMIT = 96;
    const TRAINEE_ADDRESS_MAX_CHAR_LIMIT = 90;

    public function __construct()
    {

    }

    /**
     * @param Trainee $trainee
     * @param TrainingCourse $course
     * @param string $local - this is the blade name we are gonna use ['international','en','bn2']
     * For - international - we have to show english value
     * For - en - we have to show english value
     * For - bn2 - we have to show bangla value
     * @return object
     */
    public function getCertificateData(Trainee $trainee, TrainingCourse $course, string $local)
    {
        if ($local == 'international') {
            $local = 'en';
        }

        $englishName = ucwords(strtolower($trainee->english_name));
        $banglaName = ucwords(strtolower($trainee->bangla_name));
        $designation = ucwords(strtolower(Arr::get($trainee, 'services.designation')));
        $banglaDesignation = ucwords(strtolower(Arr::get($trainee, 'services.designation_bn')));
        $fatherName = ucwords(strtolower(Arr::get($trainee, 'generalInfos.fathers_name')));
        $fatherBanglaName = ucwords(strtolower(Arr::get($trainee, 'generalInfos.fathers_name_bn')));
        $motherName = ucwords(strtolower(Arr::get($trainee, 'generalInfos.mothers_name')));
        $motherBanglaName = ucwords(strtolower(Arr::get($trainee, 'generalInfos.mothers_name_bn')));
        $presentAddress = ucwords(strtolower(Arr::get($trainee, 'generalInfos.present_address')));
        $presentBanglaAddress = ucwords(strtolower(Arr::get($trainee, 'generalInfos.present_address_bn')));
        $organization = Arr::get($trainee, 'services.organization');
        $trainingStartDate =
            $local == 'en'
                ? Carbon::parse($trainee->training->start_date)->format('d/m/Y')
                : $this->banglaNumber(Carbon::parse($trainee->training->start_date)->format('d/m/Y'));

        $trainingEndDate =
            $local == 'en'
                ? Carbon::parse($trainee->training->end_date)->format('d/m/Y')
                : $this->banglaNumber(Carbon::parse($trainee->training->end_date)->format('d/m/Y'));

        $sponsors = $this->getSponsorName($trainee->training, $local);

        $currentDate =
            $local == 'en'
                ? \Carbon\Carbon::now()->format('d/m/Y')
                : $this->banglaNumber(\Carbon\Carbon::now()->format('d/m/Y'));
        $courseNameArray = $this->getCourseName($course, $local);
        $designationAndAddress = $this->getDesignationAndAddress($designation, $presentAddress);
        return (object)[
            'id' => $trainee->id,
            'course' => $course,
            'english_name' => $this->checkAndReplaceEmptyValue($englishName),
            'name_bangla' => $this->checkAndReplaceEmptyValue($banglaName, 'bn'),
            'designation' => $this->checkAndReplaceEmptyValue($designation),
            'designation_bangla' => $this->checkAndReplaceEmptyValue($banglaDesignation, 'bn'),
            'father_name' => $this->checkAndReplaceEmptyValue($fatherName),
            'father_name_bangla' => $this->checkAndReplaceEmptyValue($fatherBanglaName, 'bn'),
            'mother_name' => $this->checkAndReplaceEmptyValue($motherName),
            'mother_name_bangla' => $this->checkAndReplaceEmptyValue($motherBanglaName, 'bn'),
            'present_address' => $this->checkAndReplaceEmptyValue($presentAddress),
            'present_address_bangla' => $this->checkAndReplaceEmptyValue($presentBanglaAddress, 'bn'),
            'organization' => $this->checkAndReplaceEmptyValue($organization),
            'training_start_date' => $trainingStartDate,
            'training_end_date' => $trainingEndDate,
            'sponsors' => $this->checkAndReplaceEmptyValue($sponsors, $local),
            'current_date' => $currentDate,
            'course_name' => $this->checkAndReplaceEmptyValue($course->name),
            'course_name_bangla' => $this->checkAndReplaceEmptyValue($course->name_bn, 'bn'),
            'course_name_array' => $courseNameArray,
            'designation_and_address' => $this->checkAndReplaceEmptyValue($designationAndAddress),
        ];
    }

    /**
     * Returns the blade name of the certificate to be shown
     * Assuming, each option has blade file
     * @param Training $training
     * @param TrainingCourse $course
     * @param string $type
     * @return string ['en','bn2']
     */
    public function getCertificateLocal(Training $training, TrainingCourse $course, $type = 'en'): string
    {
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
        return $type;
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    |                                               Private Methods
    |-------------------------------------------------------------------------------------------------------------------
    */
    public function banglaNumber($int)
    {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
        $converted = str_replace($engNumber, $bangNumber, $int);
        return $converted;
    }

    private function getSponsorName(Training $training, string $local)
    {
        if (is_null($training)) {
            return trans('labels.not_found');
        }
        // for old way, each training has organizations
        $sponsors = $training->trainingOrganizations->map(function ($org) use ($local) {
            return $local == 'en' ? $org->name : $org->bangla_name;
        })->implode(', ');

        // for new way,we moved the organizations to the head, so if training didn't have organizations
        // its training head must have organizations
        if (empty($sponsors)) {
            $sponsors = $training->trainingHead->trainingOrganizations->map(function ($org) use ($local) {
                return $local == 'en' ? $org->name : $org->bangla_name;
            })->implode(', ');
        }
        return $sponsors;
    }

    /**
     * @param TrainingCourse $course
     * @param string $local
     * @return array
     */
    private function getCourseName(TrainingCourse $course, string $local): array
    {
        $courseName = $local == 'en' ? $course->name : $course->name_bn;

        $courseLength = strlen($courseName);
        if ($courseLength > $this::COURSE_NAME_FIRST_LINE_MAX_CHAR_LIMIT) {
            // if the max limit is in between a word, we will run back until we find a space
            // then we will split the whole string into two array index
            // we will print the first line, then print the second line
            // considering 0 index,  next character will be the max character
            $courseNameArray = str_split($courseName);
            $splitIndex = $this::COURSE_NAME_FIRST_LINE_MAX_CHAR_LIMIT - 1;
            for ($i = $this::COURSE_NAME_FIRST_LINE_MAX_CHAR_LIMIT; $i >= 0; $i--) {
                if (isset($courseNameArray[$i]) && $courseNameArray[$i] == ' ') {
                    $splitIndex = $i - 1;
                    break;
                }
            }
            $firstLine = mb_substr($courseName, 0, $splitIndex + 1);
            $secondLine = mb_substr($courseName, $splitIndex + 1, $this::COURSE_NAME_SECOND_LINE_MAX_CHAR_LIMIT);
            return [
                'first_line' => $firstLine,
                'second_line' => $secondLine,
            ];
        } else {
            return [
                'first_line' => $courseName,
                'second_line' => '',
            ];
        }
    }

    /**
     * @param $designation
     * @param $address
     * @return false|string
     */
    private function getDesignationAndAddress($designation, $address)
    {
        $combined = $designation . ',' . $address;
        return mb_substr($combined, 0, $this::TRAINEE_ADDRESS_MAX_CHAR_LIMIT);
    }

    /**
     * @param $value
     * @param string $emptyMessagelocal
     * @return string
     */
    private function checkAndReplaceEmptyValue($value, $emptyMessagelocal = 'en'): string
    {
        if (empty($value)) {
            $value = $emptyMessagelocal == 'en'
                ? trans('labels.not_found', [], 'en')
                : trans('labels.bangla_input_not_found', [], 'bn');
        }
        return $value;

    }
}

