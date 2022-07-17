<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 8/8/19
 * Time: 2:51 PM
 */

namespace Modules\HRM\Services;


use App\Constants\DepartmentShortName;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Complaint;
use Modules\HRM\Entities\ComplaintAttachment;
use Modules\HRM\Repositories\ComplaintRepository;
use Modules\HRM\Repositories\EmployeeRepository;

class ComplaintService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var ComplaintRepository
     */
    private $complaintRepository;
    private $employeeRepository;

    public function __construct(
        ComplaintRepository $complaintRepository,
        EmployeeRepository $employeeRepository
    )
    {
        /** @var ComplaintRepository $complaintRepository */
        $this->complaintRepository = $complaintRepository;
        $this->employeeRepository = $employeeRepository;
        $this->setActionRepository($complaintRepository);
    }

    public function getEmpSelectOptions()
    {
        return $this->complaintRepository->getAllEmployees();
    }

    public function storeComplaint(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['status'] = 'new';
            $complaint = $this->save($data);

            if($complaint->invitation) {
                $complaint->invitation->status = 'submitted';
                $complaint->invitation->save();
            }

            $this->storeComplaintAttachment($data, $complaint);


            $isDirectorAdmin = null;

            $complainerDepartment = get_user_department($complaint->complainer->user);

            if($complaint->complainer->is_divisional_director && $complainerDepartment->department_code == DepartmentShortName::AdminDivision) {
                if($complaint->apply('review')) {
                    return $complaint->save();
                }else {
                    return false;
                }
            }else {
                if ($complaint->apply('check')) {
                    return $complaint->save();
                } else {
                    return false;
                }
            }

        });
    }

    public function dashboardActivities()
    {
        $complaints = $this->complaintRepository->findAll()
            ->filter(function ($complaint) {
                return ($this->isStateRecipient($complaint) && $complaint->status != 'rejected' && $complaint->status != 'approved');
            });

        return $complaints;
    }

    public function getVisibleComplaints()
    {
        $complaints = $this->complaintRepository->findAll()
            ->filter(function($complaint) {

                if(get_user_department()->department_code == DepartmentShortName::HrmSection) {
                    return true;
                }

                if(!is_null(auth()->user()->employee)) {
                    if($complaint->complainer->id == auth()->user()->employee->id) {
                        return true;
                    }
                }

                if($this->isStateRecipient($complaint)) {
                    return true;
                }

            });

        return $complaints;
    }

    private function isStateRecipient(Complaint $complaint)
    {
        $lastStateHistory = $complaint->stateHistory()->get()->last();

        if (!is_null($lastStateHistory)) {
            return DB::table('state_recipients')
                ->where('state_history_id', $lastStateHistory->id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return false;
    }

    private function storeComplaintAttachment($data, $complaint)
    {
        if (!empty($data['attachment']))
        {
            $file = $data['attachment'];
            $fileName = $file->getClientOriginalName();
            $filePath = $this->upload($file, "complaint-files/{$complaint->id}");

            $complaintAttachment = new ComplaintAttachment([
                'file_name' => $fileName,
                'file_path' => $filePath

            ]);
            $complaint->attachments()->save($complaintAttachment);
        }
    }
}