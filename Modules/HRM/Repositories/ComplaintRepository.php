<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 8/8/19
 * Time: 3:03 PM
 */

namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Entities\Complaint;
use Modules\HRM\Entities\Employee;

class ComplaintRepository extends AbstractBaseRepository
{
    protected $modelName = Complaint::class;

    public function getAllEmployees()
    {
        $employees = Employee::all()
            ->filter(function ($employee) {
                return $employee->id != Auth::user()->employee->id;
            })
            ->mapWithKeys(function ($employee) {
                return [$employee->id => $employee->getName(). " - " . $employee->getDesignation() . " - " . $employee->employeeDepartment->name];
            });
        return $employees;
    }
}