<?php

/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/14/19
 * Time: 4:22 PM
 */

namespace Modules\TMS\Services;

use App\Mail\TrainingRegistrationMail;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\TMS\Entities\RegisteredTraineeEducation;
use Modules\TMS\Entities\RegisteredTraineeEmergency;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;
use Modules\TMS\Entities\RegisteredTraineeHealthExam;
use Modules\TMS\Entities\RegisteredTraineePhysicalInfo;
use Modules\TMS\Entities\RegisteredTraineeServiceInfo;
use Modules\TMS\Entities\Training;
use Modules\TMS\Repositories\RegisteredTraineeRepository;

class RegisteredTraineeService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var RegisteredTraineeRepository
     */
    private $registeredTraineeRepository;

    public function __construct(RegisteredTraineeRepository $registeredTraineeRepository)
    {
        /** @var RegisteredTraineeRepository $registeredTraineeRepository */
        $this->registeredTraineeRepository = $registeredTraineeRepository;

        $this->setActionRepository($registeredTraineeRepository);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            if (array_key_exists('lang_preference', $data)) {
                $options = Training::getLangPreferences();
                $preference = $data['lang_preference'];
                $bnFieldNames = $this->getLangDependentFieldNames()['bn'];
                $enFieldNames = $this->getLangDependentFieldNames()['en'];
                if ($preference == $options['only_english']) {
                    // set the bangla field names from english field
                    $data[$bnFieldNames['badge_name_bn']] = $data['badge_name'] ?? '';
                    $data[$bnFieldNames['bangla_name']] = $data['english_name'] ?? '';
                    $data[$bnFieldNames['fathers_name_bn']] = $data['fathers_name'] ?? '';
                    $data[$bnFieldNames['mothers_name_bn']] = $data['mothers_name'] ?? '';
                    $data[$bnFieldNames['present_address_bn']] = $data['present_address'] ?? '';
                    $data[$bnFieldNames['designation_bn']] = $data['designation'] ?? '';
                }
                if ($preference == $options['only_bangla']) {
                    // set the english field names from bangla field
                    $data[$enFieldNames['badge_name']] = $data['badge_name_bn'] ?? '';
                    $data[$enFieldNames['english_name']] = $data['bangla_name'] ?? '';
                    $data[$enFieldNames['fathers_name']] = $data['fathers_name_bn'] ?? '';
                    $data[$enFieldNames['mothers_name']] = $data['mothers_name_bn'] ?? '';
                    $data[$enFieldNames['present_address']] = $data['present_address_bn'] ?? '';
                    $data[$enFieldNames['designation']] = $data['designation_bn'] ?? '';
                }
            }

            if (array_key_exists('photo', $data)) {
                $file = $data['photo'];
                $photoName = $file->getClientOriginalName();
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

            $data['register_to_online'] = 'online';

            $trainee = $this->save($data);
            $this->saveTraineeGeneralInfo($data, $trainee);
            $this->saveTraineeServiceInfo($data, $trainee);
            $this->saveTraineeEmergencyContact($data, $trainee);
            $this->saveTraineeEducation($data, $trainee);

            if ($trainee && !empty($data['email'])) {
                try {
                    Mail::to($data['email'])->send(new TrainingRegistrationMail($trainee));
                } catch (\Exception $exception) {
                    Log::error("Modules: TMS -> " . get_class($this) . " : {$exception->getMessage()}\n{$exception->getTraceAsString()}");
                }
            }

            return $trainee;
        });
    }

    public function getLangDependentFieldNames()
    {
        $languageEnFields = [
            'badge_name' => 'badge_name',
            'english_name' => 'english_name',
            'fathers_name' => 'fathers_name',
            'mothers_name' => 'mothers_name',
            'present_address' => 'present_address',
            'designation' => 'designation'
        ];
        $languageBnFields = [
            'badge_name_bn' => 'badge_name_bn',
            'bangla_name' => 'bangla_name',
            'fathers_name_bn' => 'fathers_name_bn',
            'mothers_name_bn' => 'mothers_name_bn',
            'present_address_bn' => 'present_address_bn',
            'designation_bn' => 'designation_bn'
        ];
        return [
            'en' => $languageEnFields,
            'bn' => $languageBnFields
        ];
    }
    //-------------------------------------------------------------------------------------------
    //                              Private Methods
    //-------------------------------------------------------------------------------------------

    private function saveTraineeGeneralInfo($data, $trainee): void
    {
        $traineeGeneralInfo = new RegisteredTraineeGeneralInfo($data);
        $trainee->generalInfos()->save($traineeGeneralInfo);
    }

    private function saveTraineeServiceInfo($data, $trainee): void
    {
        $traineeServiceInfo = new RegisteredTraineeServiceInfo($data);
        $trainee->services()->save($traineeServiceInfo);
    }

    private function saveTraineeEmergencyContact($data, $trainee): void
    {
        if (array_key_exists('mobile_no', $data)) {
            $data['mobile_no'] = bn2enNumber($data['mobile_no']);
        }

        $traineeEmergencyContact = new RegisteredTraineeEmergency($data);
        $trainee->emergencyContacts()->save($traineeEmergencyContact);
    }

    private function saveTraineeEducation($data, $trainee): void
    {
        $traineeEducation = new RegisteredTraineeEducation($data);
        $trainee->educations()->save($traineeEducation);
    }

    private function saveTraineePhysicalInfo($data, $trainee): void
    {
        $traineePhysicalInfo = new RegisteredTraineePhysicalInfo($data);
        $trainee->physicalInfos()->save($traineePhysicalInfo);
    }

    private function saveTraineeHealthExam($data, $trainee): void
    {
        $traineeHealthExam = new RegisteredTraineeHealthExam($data);
        $trainee->healthExaminations()->save($traineeHealthExam);
    }
}
