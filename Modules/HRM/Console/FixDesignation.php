<?php

namespace Modules\HRM\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Department;
use Modules\HRM\Entities\Designation;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeService;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FixDesignation extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fix:designation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command To Replace Irrelevant Designation Employee To Actual One From An Excel Sheet!';

    private $designationService;
    private $departmentService;
    private $employeeService;

    public function __construct(
        DesignationService $designationService,
        DepartmentService $departmentService,
        EmployeeService $employeeService
    ) {
        parent::__construct();
        $this->designationService = $designationService;
        $this->departmentService = $departmentService;
        $this->employeeService = $employeeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $reader = new Xlsx();
            $reader->setReadDataOnly(true);
            $file = $reader->setReadEmptyCells(false)->load('public/new-designations.xlsx');
            $sheet = $file->getActiveSheet();
            $data = $sheet->toArray(
                null,
                true,
                true,
                true
            );
            foreach ($data as $key => $value) {
                if ($key == 1) {
                    continue; // ignore the header lines
                }

                $designationShortCode = $value['C'];
                $deptShortCode = $value['D'];
                $department = $this->getDepartment($deptShortCode);
                $oldDesignation = $this->designationService->findBy(['short_name' => $designationShortCode])->first();
                $newDesignation = $this->createOrGetNewDesignation($value);
                if (!is_null($oldDesignation) && !is_null($newDesignation)) {
                    // update each employee department
                    $employees = Employee::query()->where('designation_id', $oldDesignation->id)->get();
                    if (!is_null($department)) {
                        foreach ($employees as $employee) {
                            $employee->update(['department_id' => $department->id]);
                        }
                    }
                    // update the designation
                    Employee::query()->where('designation_id',
                        $oldDesignation->id)->update(['designation_id' => $newDesignation->id]);
                    $oldDesignation->delete();
                }
            }
        } catch (\Exception $exception) {
            echo "run into so error ";
            echo $exception->getMessage();
        }
    }

    public function createOrGetNewDesignation(array $value)
    {
        $deptShortCode = $value['D'];
        $revisedName = $value['E'];
        $revisedBanglaName = $value['F'];
        $newShortCode = $value['G'];
        $revisedLevel = $value['H'];
        return Designation::query()->updateOrCreate(
            ['short_name' => $newShortCode], [
            'name' => $revisedName,
            'bangla_name' => $revisedBanglaName,
            'hierarchy_level' => $revisedLevel
        ]);
    }

    private function getDepartment($departmentCode)
    {
        if ($departmentCode == 'NULL') {
            return null;
        }
        return $this->departmentService->findBy(['department_code' => $departmentCode])->first();
    }


}
