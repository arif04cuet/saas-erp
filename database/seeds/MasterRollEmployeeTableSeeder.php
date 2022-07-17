<?php

use Illuminate\Database\Seeder;
use Modules\HRM\Entities\Employee;

class MasterRollEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_roll_employees')->delete();
        DB::table('master_roll_salaries')->delete();
        $this->createEmployee();
    }

    private function createEmployee()
    {

        foreach ($this->getName() as $name) {

            $firstName = explode(" ", $name, 2)[0];
            $lastName = explode(" ", $name, 2)[1];
            $employeeId = $this->getEmployeeId()[$name];
            $email = $employeeId . '@gmail.com';
            $employee = Employee::updateOrCreate(['employee_id' => $employeeId], [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'employee_id' => $employeeId,
                'email' => $email,
                'gender' => 'Male',
                'department_id' => 9,
                'designation_id' => 2,
                'status' => 'master roll',
            ]);
            \Modules\Accounts\Entities\MasterRollEmployee::updateOrCreate(['employee_id' => $employeeId], [
                'employee_id' => $employee->id,
                'payment_per_day' => 375,

            ]);
        }
    }

    private function getName(): array
    {
        return [
            'জনাব অর্জুন দাস',
            'হুমায়ুন কবির',
            'নাসির উদ্দিন',
            'মমতাজ উদ্দিন',
            'নাজমা বেগম',
            'সঞ্চয় কুমার ত্রিপুরা',
            'আনিসুর রহমান',
            'বিকাশ চন্দ্র দাস',
            'লোকমান হোসেন',
            'মামুনুর রশিদ',
            'আল আমিন',
            'আব্দুল খালেক',
        ];
    }

    private function getEmployeeId(): array
    {
        return [
            'জনাব অর্জুন দাস' => 'arjun_dash_master',
            'হুমায়ুন কবির' => 'humayun_kabir_master',
            'নাসির উদ্দিন' => 'nasir_uddin_master',
            'মমতাজ উদ্দিন' => 'mamtaz_uddin_master',
            'নাজমা বেগম' => 'nazma_begum_master',
            'সঞ্চয় কুমার ত্রিপুরা' => 'sonchoi_kumar_tripura_master',
            'আনিসুর রহমান' => 'anisur_rahman',
            'বিকাশ চন্দ্র দাস' => 'bikash_chandra_dash_master',
            'লোকমান হোসেন' => 'lokman_hossain_master',
            'মামুনুর রশিদ' => 'mamunur_rashid_master',
            'আল আমিন' => 'al_amin_master',
            'আব্দুল খালেক' => 'abdul_khalek_master',
        ];
    }
}
