<?php

use Illuminate\Database\Seeder;
use Modules\Accounts\Entities\PostRetirementLeaveEmployee;
use Modules\HRM\Entities\Employee;

class PostRetirementLeaveEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostRetirementLeaveEmployee::truncate();
        //$this->retireEmployee();
    }

    private function getToBeRetiredEmployeeList()
    {
        return [
            'FM10',
            'PD1',
            'mizanbard',
            'mashudur.rahmanbard'
        ];
    }

    public function retireEmployee(): void
    {
        $retireTobeEmployees = $this->getToBeRetiredEmployeeList();
        $eligibleMonth = 13;
        foreach ($retireTobeEmployees as $employee_id) {
            $employee = Employee::where('employee_id', $employee_id)->first();
            $employee->is_retired = 1;
            $employee->save();
            DB::table('post_retirement_leave_employees')->insert([
                [
                    'employee_id' => $employee->id,
                    'start_date' => \Carbon\Carbon::now(),
                    'end_date' => \Carbon\Carbon::now()->addMonth($eligibleMonth),
                    'total_amount' => $eligibleMonth * optional($employee->employeeContract)->getBasicSalary(),
                    'eligible_month' => $eligibleMonth,
                    'basic_salary' => optional($employee->employeeContract)->getBasicSalary(),
                ],
            ]);

        }
    }
}
