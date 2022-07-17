<?php

namespace Database\Seeders;

use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\HRM\Entities\Employee;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            'first_name' => 'Md',
            'last_name' => 'Shajahan',
            'photo' => 'HaxWeQhK3XsgIdBuQj2pNbiF2SjVde5UdsEMwUtd.png',
            'email' => 'supperadmin@gmail.com',
            'gender' => 'male',
            'department_id' => 7,
            'designation_id' => '26',
            'is_divisional_director' => 0,
            'status' => 'permanent',
            'tel_office' => NULL,
            'tel_home' => NULL,
            'mobile_one' => '01732609889',
            'mobile_two' => NULL,
            'created_at' => '2020-02-25 16:35:02',
            'updated_at' => '2020-02-25 16:35:02',
            'deleted_at' => NULL,
            'other_duties' => NULL,
            'section_id' => NULL,
            'is_retired' => 0,
            'religion_id' => NULL,
            'doptor_id' => 1
        ];

        $userData = array(
            'name' => 'Md Shajahan',
            'email' => 'supperadmin@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('12345678'),
            'remember_token' => NULL,
            'created_at' => '2020-02-25 16:35:02',
            'updated_at' => '2020-02-25 16:35:02',
            'username' => 'supper_admin',
            'user_type' => 'Employee',
            'mobile' => '01732609096',
            'reference_table_id' => 304,
            'status' => 'Active',
            'deleted_at' => NULL,
            'last_password_change' => NULL,
        );
        $roleSuperAdmin = array(
            'name' => 'ROLE_SUPER_ADMIN',
            'description' => 'HRM Section Officer',
            'created_at' => null,
            'updated_at' => null,
        );


        DB::transaction(function () use ($employee, $userData, $roleSuperAdmin) {
            $employee = Employee::create($employee);
            $user = User::create($userData);

            $employee->user()->save($user);

            $role = Role::create($roleSuperAdmin);

            $user->roles()->attach($role);
        });
    }
}
