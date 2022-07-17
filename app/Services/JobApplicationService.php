<?php
/**
 * Created by PhpStorm.
 * User: BS130
 * Date: 1/16/19
 * Time: 8:15 PM
 */

namespace App\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Mail\JobApplicantMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Entities\JobApplicantPicture;
use Illuminate\Database\Eloquent\Model;
use App\Utilities\EnToBnNumberConverter;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Repositories\JobApplicationRepository;
use App\Repositories\JobApplicantAddressRepository;
use App\Repositories\JobApplicantPictureRepository;
use Modules\HRM\Repositories\JobCircularRepository;
use App\Repositories\JobApplicantEducationRepository;
use App\Repositories\JobApplicantExperienceRepository;
use Modules\HRM\Repositories\JobApplicantResearchRepository;
use Modules\HRM\Services\CVEvaluationService\DefaultCVEvaluationService;

class JobApplicationService
{
    use CrudTrait;
    use FileTrait;
    private $jobApplicationRepository;
    private $jobApplicantAddressRepository;
    private $jobApplicantEducationRepository;
    private $jobApplicantPictureRepository;
    /**
     * @var JobCircularRepository
     */
    private $jobCircularRepository;
    /**
     * @var JobApplicantExperienceRepository
     */
    private $jobApplicantExperienceRepository;

    /**
     * @var JobApplicantResearchRepository
     */

    private $jobApplicantResearchRepository;


    /**
     * JobApplicationService constructor.
     * @param JobApplicationRepository $jobApplicationRepository
     * @param JobApplicantAddressRepository $jobApplicantAddressRepository
     * @param JobApplicantEducationRepository $jobApplicantEducationRepository
     * @param JobApplicantPictureRepository $jobApplicantPictureRepository
     * @param JobCircularRepository $jobCircularRepository
     * @param JobApplicantExperienceRepository $jobApplicantExperienceRepository
     * @param JobApplicantResearchRepository $jobApplicantResearchRepository
     */
    public function __construct(
        JobApplicationRepository $jobApplicationRepository,
        JobApplicantAddressRepository $jobApplicantAddressRepository,
        JobApplicantEducationRepository $jobApplicantEducationRepository,
        JobApplicantPictureRepository $jobApplicantPictureRepository,
        JobCircularRepository $jobCircularRepository,
        JobApplicantExperienceRepository $jobApplicantExperienceRepository,
        JobApplicantResearchRepository $jobApplicantResearchRepository
    ) {
        $this->jobApplicationRepository = $jobApplicationRepository;
        $this->jobApplicantAddressRepository = $jobApplicantAddressRepository;
        $this->jobApplicantEducationRepository = $jobApplicantEducationRepository;
        $this->jobApplicantPictureRepository = $jobApplicantPictureRepository;
        $this->setActionRepository($jobApplicationRepository);
        $this->jobCircularRepository = $jobCircularRepository;
        $this->jobApplicantExperienceRepository = $jobApplicantExperienceRepository;
        $this->jobApplicantResearchRepository = $jobApplicantResearchRepository;
    }

    // Public function store that accepts data array to save in DB and returns the saved item
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            //Saving Present and Permanent Addresses
            foreach ($data['address_type'] as $key => $addressType) {
                $addressData = $this->prepareAddressData($data, $key);
                $savedAddress = $this->jobApplicantAddressRepository->save($addressData);
                $data[$addressType] = $savedAddress->id;
            }

            //Saving Application
            if (!empty($data['same_as_present'])) {
                $data['permanent_address'] = $data['present_address'];
            }
            $data['birth_date'] = date('y-m-d', strtotime($data['birth_date']));
            $data['payment_date'] = date('y-m-d', strtotime($data['payment_date']));
            $data['applicant_id'] = $this->generateApplicantId($data['circular_no']);
            $savedApplication = $this->save($data);

            // Saving Education Data
            foreach ($data['education_information'] as $educationData) {
                //$educationData = $this->prepareEducationData($data, $key, $educationLevel);
                $educationData['job_application_id'] = $savedApplication->id;
                $savedEducation = $this->jobApplicantEducationRepository->save($educationData);
            }

            // Saving Experience Data
            if (isset($data['add_experience'])) {
                foreach ($data['experience_information'] as $experienceData) {
                    $experienceData['job_application_id'] = $savedApplication->id;
                    $experienceData['from'] =  date('y-m-d', strtotime($experienceData['from']));
                    if (isset($experienceData['to'])) {
                        $experienceData['to'] =  date('y-m-d', strtotime($experienceData['to']));
                    }
                    $this->jobApplicantExperienceRepository->save($experienceData);
                }
            }

            // Saving Research Data
            if (isset($data['add_research'])) {
                foreach ($data['research_information'] as $researchData) {
                    $researchData['job_application_id'] = $savedApplication->id;
                    $researchData['from'] = date('y-m-d', strtotime($researchData['from']));
                    $researchData['to'] = date('y-m-d', strtotime($researchData['to']));

                    $this->jobApplicantResearchRepository->save($researchData);
                }
            }


            // Check this application's circular has system shortlist enabled & if so, run DefaultCVEvaluation on it
            if ($savedApplication->jobCircular->system_shortlist) {
                $evaluation = new DefaultCVEvaluationService(
                    $savedApplication->jobCircular,
                    $savedApplication,
                    $savedApplication->jobCircular->qualificationRule
                );

                $evaluation->evaluate();

                if ($evaluation->shortListed) {
                    $savedApplication->update(['status' => 'short_listed']);
                }
            }

            $this->storePicture($data, $savedApplication->id);

            return $savedApplication;
        });
    }

    // Private Function to prepare list of address data to store in the database
    private function prepareAddressData(array $data, int $key): array
    {
        $addressData ['care_of'] = $data['care_of'][$key];
        $addressData ['road_and_house'] = $data['road_and_house'][$key];
        $addressData ['district'] = $data['district'][$key];
        $addressData ['sub_district'] = $data['sub_district'][$key];
        $addressData ['post_office'] = $data['post_office'][$key];
        $addressData ['post_code'] = $data['post_code'][$key];
        return $addressData;
    }

    public function storePicture(array $data, $application_id)
    {
        // Saving Applicant Photo
        $fileName = $data['photo']->getClientOriginalName();
        $filePath = $this->upload($data['photo'], 'job-applicants/photos');
        $file = [
            'job_application_id' => $application_id,
            'type' => 'photo',
            'file_name' => $fileName,
            'file_location' => $filePath,
        ];
        $this->jobApplicantPictureRepository->save($file);

        // Saving Applicant Signature
        $fileName = $data['signature']->getClientOriginalName();
        $filePath = $this->upload($data['signature'], 'job-applicants/signatures');
        $file = [
            'job_application_id' => $application_id,
            'type' => 'signature',
            'file_name' => $fileName,
            'file_location' => $filePath,
        ];

        $savedApplication = $this->jobApplicantPictureRepository->save($file);

        if ($savedApplication) {
            $this->emailToApplicant($savedApplication->job_application_id);
        }

        return true;
    }

    public function emailToApplicant($applicantId)
    {
        $applicant = $this->findOne($applicantId);
        if ($applicant) {
            $to = $applicant->email;
            Mail::to($to)->send(new JobApplicantMail($applicant));
        }

    }

    public function storeUpdate(Model $model, array $data)
    {
        return $model->update($data);
    }

    /**
     * Generates applicant id
     * @param $circularId
     * @return string
     */
    private function generateApplicantId($circularId)
    {
        $circular = $this->jobCircularRepository->findOne($circularId) ?? null;
        $applicantsNo = $circular ? $circular->jobApplications->count() : 0;
        return $circular->id . (str_pad($applicantsNo, 6, '0', STR_PAD_LEFT));
    }

}
