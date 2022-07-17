<?php

/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 7/29/19
 * Time: 3:26 PM
 */

namespace Modules\HRM\Services;

use App\Constants\DepartmentShortName;
use App\Constants\DesignationShortName;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Appraisal;
use Modules\HRM\Entities\AppraisalDetail;
use Modules\HRM\Entities\AppraisalMetadata;
use Modules\HRM\Entities\AppraisalReceiver;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Repositories\AppraisalContentRepository;
use Modules\HRM\Repositories\AppraisalRepository;
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\HRM\Repositories\SectionRepository;

class AppraisalService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AppraisalRepository
     */
    private $appraisalRepository;
    /**
     * @var AppraisalContentRepository
     */
    private $appraisalContentRepository;

    private $employeeRepository;

    private $sectionRepository;

    private $employeeService;

    public function __construct(
        AppraisalRepository $appraisalRepository,
        AppraisalContentRepository $appraisalContentRepository,
        EmployeeRepository $employeeRepository,
        EmployeeService $employeeService,
        SectionRepository $sectionRepository
    ) {

        /** @var AppraisalRepository $appraisalRepository */
        $this->appraisalRepository = $appraisalRepository;
        $this->setActionRepository($this->appraisalRepository);
        /** @var AppraisalContentRepository $appraisalContentRepository */
        $this->appraisalContentRepository = $appraisalContentRepository;
        $this->employeeRepository = $employeeRepository;
        $this->employeeService = $employeeService;
        $this->sectionRepository = $sectionRepository;
    }

    public function storeAppraisal(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data = $this->parseDuration($data);

            $finisher = $this->pullTheFinisher($data['type'], $data['reporting_employee_id']);

            $data['finisher_id'] = $finisher ? $finisher->id : null;
            $data['status'] = "new";

            $appraisal = $this->save($data);

            $this->saveAppraisalDetails($data, $appraisal);

            $this->saveAppraisalMetadata($data, $appraisal);

            return $this->applyTransition($appraisal, $data['type']);
        });
    }

    private function parseDuration($data)
    {
        if (isset($data['start_date'])) {
            $data['start_date'] = Carbon::createFromFormat("j F, Y", $data['start_date']);
        } else {
            $data['start_date'] = Carbon::createFromFormat(
                'j F, Y',
                $data['reporting_officer_job_duration_start_date']
            );
        }

        if (isset($data['end_date'])) {

            $data['end_date'] = Carbon::createFromFormat("j F, Y", $data['end_date']);
        } else {
            $data['end_date'] = Carbon::createFromFormat('j F, Y', $data['reporting_officer_job_duration_end_date']);
        }

        return $data;
    }

    public function getAvailableAppraisals()
    {
        $appraisals = $this->appraisalRepository->findAll()
            ->reject(function ($apprisal) {
                return ($apprisal->status == 'completed' && !Auth::user()->can('admin-access'));
            })
            ->filter(function ($appraisal) {

                if (get_user_department()->department_code == DepartmentShortName::HrmSection) {
                    return true;
                }

                if ($appraisal->initiator->user) {
                    if ($appraisal->initiator->user->id == auth()->user()->id) {
                        return true;
                    }
                }

                if ($this->isStateRecipient($appraisal)) {
                    return true;
                }

                return false;
            });

        return $appraisals;
    }

    public function dashboardActivities()
    {
        $appraisals = $this->appraisalRepository->findAll()
            ->filter(function ($appraisal) {
                return ($this->isStateRecipient($appraisal) && $appraisal->status != "completed");
            });

        return $appraisals;
    }

    private function isStateRecipient($appraisal)
    {
        $lastStateHistory = $appraisal->stateHistory()->get()->last();

        if (!is_null($lastStateHistory)) {
            return DB::table('state_recipients')
                ->where('state_history_id', $lastStateHistory->id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return false;
    }

    private function pullTheFinisher($class, $reportingEmployee)
    {
        switch ($class) {
            case 'first':
                return $this->employeeService->findAll()
                    ->filter(function ($employee) {
                        if ($employee->designation)
                            return $employee->designation->short_name == DesignationShortName::DG;
                    })->first();
                break;
            case 'second':
                return $this->employeeService->findAll()
                    ->filter(function ($employee) {
                        if ($employee->designation)
                            return $employee->designation->short_name == DesignationShortName::DA;
                    })->first();
                break;
            case 'third':
                if ($this->isReportingEmployeeSectionOfficer($reportingEmployee)) {
                    return $this->employeeService->findAll()
                        ->filter(function ($employee) {
                            if ($employee->designation)
                                return $employee->designation->short_name == DesignationShortName::DA;
                        })->first();
                } else {
                    $reportingEmployee = $this->employeeService->findOne($reportingEmployee);
                    return $this->employeeService->getDivisionalDirectorByDepartmentId($reportingEmployee->employeeDepartment->id);
                }
                break;
            case 'fourth':
                $reportingEmployee = $this->employeeService->findOne($reportingEmployee);
                return $this->employeeService->getDivisionalDirectorByDepartmentId($reportingEmployee->employeeDepartment->id);
                break;

            default:
                return new Employee();
        }
    }


    private function isReportingEmployeeSectionOfficer($reportingEmployee)
    {
        return $this->sectionRepository->findBy([
            'section_head_employee_id' => $reportingEmployee
        ])->first();
    }

    private function saveAppraisalDetails($data, $appraisal)
    {
        if (isset($data['content'])) {
            foreach ($data['content'] as $key => $value) {
                AppraisalDetail::create([
                    'appraisal_id' => $appraisal->id,
                    'content_id' => $key,
                    'marks' => $value['value'],
                    'remarks' => isset($value['remarks']) ? $value['remarks'] : null
                ]);
            }
        }
    }

    private function saveAppraisalMetadata($data, $appraisal)
    {
        $metadataKeys = config('appraisal.metadata.config');

        foreach ($metadataKeys as $key => $properties) {
            if (isset($data[$key])) {
                if ($properties['type'] == 'file') {
                    $fileName = $data[$key]->getClientOriginalName();

                    $path = $this->upload($data[$key], 'appraisal-metadata-files');

                    $appraisalMetadata = AppraisalMetadata::create([
                        'appraisal_id' => $appraisal->id,
                        'key' => $key,
                        'value' => json_encode(
                            [
                                'file_name' => $fileName,
                                'file_path' => $path
                            ]
                        )
                    ]);
                } else {
                    if ($properties['type'] == 'date') {
                        $appraisalMetadata = AppraisalMetadata::create([
                            'appraisal_id' => $appraisal->id,
                            'key' => $key,
                            'value' => Carbon::createFromFormat('j F, Y', $data[$key])
                        ]);
                    } else {
                        if ($properties['type'] == 'array') {
                            $appraisalMetadata = AppraisalMetadata::create([
                                'appraisal_id' => $appraisal->id,
                                'key' => $key,
                                'value' => json_encode($data[$key])
                            ]);
                        } else {
                            $appraisalMetadata = AppraisalMetadata::create([
                                'appraisal_id' => $appraisal->id,
                                'key' => $key,
                                'value' => $data[$key]
                            ]);
                        }
                    }
                }
            }
        }
    }

    private function applyTransition($appraisal, $type)
    {
        switch ($type) {
            case 'fourth':
                if ($appraisal->apply('reporting')) {
                    return $appraisal->save();
                }
                break;
            case 'third':
                if ($appraisal->apply('reporting')) {
                    return $appraisal->save();
                }
                break;
            case 'second':
                if ($appraisal->apply('reporting')) {
                    return $appraisal->save();
                }
                break;
            case 'first':
                if ($appraisal->apply('initialize')) {

                    return $appraisal->save();
                }
                break;
            default:
                break;
        }
    }


    public function getPossibleReporters($appraisal)
    {
        $reporters = $this->employeeRepository->findAll()
            ->filter(function ($reporter) use ($appraisal) {
                return (!in_array($reporter->id, [
                    $appraisal->reportingEmployee->id,
                    $appraisal->medicalReporter->id,
                    $appraisal->finisher->id
                ]));
            })->mapWithKeys(function ($reporter) {
                $value = [];
                $reporter->first_name ? $value[] = $reporter->first_name : false;
                $reporter->last_name ? $value[] = $reporter->last_name : false;
                $reporter->designation ? $value[] = $reporter->designation->name : false;
                $reporter->employeeDepartment ? $value[] = $reporter->employeeDepartment->department_code : false;

                return [$reporter->id => implode(" ", $value)];
            });

        return $reporters;
    }

    public function getPossibleSigners($appraisal)
    {
        $signers = $this->employeeRepository->findAll()
            ->filter(function ($signer) use ($appraisal) {
                return (!in_array($signer->id, [
                    $appraisal->reportingEmployee->id,
                    $appraisal->medicalReporter->id,
                    $appraisal->finisher->id,
                    $appraisal->reporter->id
                ]));
            })->mapWithKeys(function ($signer) {
                $value = [];
                $signer->first_name ? $value[] = $signer->first_name : false;
                $signer->last_name ? $value[] = $signer->last_name : false;
                $signer->designation ? $value[] = $signer->designation->name : false;
                $signer->employeeDepartment ? $value[] = $signer->employeeDepartment->department_code : false;

                return [$signer->id => implode(" ", $value)];
            });

        return $signers;
    }

    public function updateAppraisal(Appraisal $appraisal, $data)
    {
        return DB::transaction(function () use ($data, $appraisal) {

            //            if(isset($data['reporter_officer_date'])) {
            //                $data['reporter_officer_date'] = Carbon::createFromFormat('j F, Y', $data['reporter_officer_date']);
            //            }
            //
            //            if(isset($data['signer_officer_date'])) {
            //                $data['signer_officer_date'] = Carbon::createFromFormat('j F, Y', $data['signer_officer_date']);
            //            }
            //
            //            if(isset($data['finisher_officer_date'])) {
            //                $data['finisher_officer_date'] = Carbon::createFromFormat('j F, Y', $data['finisher_officer_date']);
            //            }
            //
            //            if(isset($data['health_officer_date'])) {
            //                $data['health_officer_date'] = Carbon::createFromFormat('j F, Y', $data['health_officer_date']);
            //            }

            $appraisal->update($data);


            if (isset($data['content'])) {
                $this->saveAppraisalDetails($data, $appraisal);
            }

            $this->saveAppraisalMetadata($data, $appraisal);

            switch ($appraisal->status) {
                case 'reported':
                    $appraisal->apply('signing');
                    return $appraisal->save();
                    break;
                case 'signed':
                    $appraisal->apply('completing');
                    return $appraisal->save();
                    break;
                case 'initialized':
                    if ($appraisal->stateHistory()->get()->last()->from == 'new') {
                        $appraisal->apply('verifying');
                    } else {
                        $appraisal->apply('reporting');
                    }
                    return $appraisal->save();
                    break;
                case 'verified':
                    $appraisal->apply('initialize');
                    return $appraisal->save();
                    break;
                default:
                    break;
            }

            return false;
        });
    }

    public function getAppraisalContents($class)
    {
        return $this->appraisalContentRepository->findBy([
            'class' => $class
        ]);
    }

    private function saveAppraisalInitiator($data, $appraisal)
    {
        $signatureFile = $data['signature'];
        $signatureFileName = $signatureFile->getClientOriginalName();
        $signatureFilePath = $this->upload($signatureFile, 'appraisal-reporter-files');

        $sealFile = $data['seal'];
        $sealFileName = $sealFile->getClientOriginalName();
        $sealFilePath = $this->upload($sealFile, 'appraisal-reporter-files');

        AppraisalReceiver::create([
            'appraisal_id' => $appraisal->id,
            'receiver_id' => $data['receiver_id'],
            'is_initiator' => 1,
            'signature' => $signatureFilePath,
            'seal' => $sealFilePath
        ]);
    }
}
