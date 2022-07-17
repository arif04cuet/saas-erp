<?php

namespace Modules\HRM\Console;

use App\Entities\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\HRM\Entities\Employee;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModifyHrmAndAccountsDataForDemo extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'modify:hrm-accounts-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to change sensitive information from the outer organization';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->modifyEmployeeInformation();
        $this->removeSensitiveInformation();
        $this->modifyUserInformation();
    }

    private function modifyEmployeeInformation()
    {
        $i = 1000;
        Employee::all()->each(function ($employee) use (&$i) {
            $employee->first_name = 'Dummy First Name';
            $employee->last_name = 'Dummy Last Name';
            $employee->email= 'demoemail' . $i++ . '@demo.com';
            $employee->mobile_one = '01722222222';
            $employee->save();
        });


    }

    private function modifyUserInformation()
    {
        $i = 1000;
        User::all()->each(function ($user) use (&$i) {
            $user->password = Hash::make('123123');
            $user->email = 'demoemail' . $i++ . '@demo.com';
            $user->name = 'Dummy Name';
            $user->mobile = '01722222222';
            $user->save();
        });
    }

    private function removeSensitiveInformation()
    {
        Employee::with(
            'employeeSpouseChildrenInfo',
            'employeeContract',
            'employeeEducationInfo',
            'employeeTrainingInfo',
            'employeePersonalInfo')
            ->each(function ($employee) {

                //remove spouse children information
                if (!is_null($employee->employeeSpouseChildrenInfo)) {
                    $employee->employeeSpouseChildrenInfo()->delete();
                }
                // remove accounts related information
                if (!is_null($employee->employeeContract)) {
                    $employee->employeeContract()->delete();
                }
                // remove training,education information
                if (!is_null($employee->employeeEducationInfo)) {
                    $employee->employeeEducationInfo()->delete();
                }
                if (!is_null($employee->employeeTrainingInfo)) {
                    $employee->employeeTrainingInfo()->delete();
                }
                // modify Personal Information
                $this->modifyPersonalInformation($employee);
            });
    }

    private function modifyPersonalInformation(Employee $employee)
    {
        $employee->employeePersonalInfo()->update([
            'father_name' => "Dummy Name",
            'mother_name' => 'Dummy Name',
            'husband_name' => 'Dummy Name',
            'date_of_birth' => '1977-11-11',
            'salary_scale' => 'Grade 8',
            'total_salary' => '50000'
        ]);
    }


}
