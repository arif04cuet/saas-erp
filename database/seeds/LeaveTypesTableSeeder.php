<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->truncate();

        $now = \Carbon\Carbon::now();

        // amount & maximum allowed days is editable from UI
        DB::table('leave_types')->insert([
            //            [
            //                'name' => 'earned_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'earned_leave_description',
            //                'created_at' => $now,
            //            ],
            [
                'name' => 'average_salary_earned_leave',
                'is_parent' => false,
                'parent_id' => 1,
                'mother_type_id' => null,
                'description' => 'average_salary_earned_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 300,
                'maximum_allowed_days' => null
            ],
            [
                'name' => 'half_average_salary_earned_leave',
                'is_parent' => false,
                'parent_id' => 1,
                'mother_type_id' => null,
                'description' => 'half_average_salary_earned_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 780,
                'maximum_allowed_days' => null
            ],
            [
                'name' => 'extraordinary_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => null,
                'description' => 'extraordinary_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 720,
                'maximum_allowed_days' => null
            ],
            [
                'name' => 'study_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 2,
                'description' => 'study_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 840,
                'maximum_allowed_days' => null
            ],
            [
                'name' => 'quarantine_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 1,
                'description' => 'quarantine_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 30,
                'maximum_allowed_days' => 30
            ],
            [
                'name' => 'maternity_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 1,
                'description' => 'maternity_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 180,
                'maximum_allowed_days' => 180
            ],
            [
                'name' => 'not_due_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 2,
                'description' => 'not_due_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 455,
                'maximum_allowed_days' => null
            ],
            [
                'name' => 'post_retirement_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => null,
                'description' => 'post_retirement_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 365,
                'maximum_allowed_days' => 365
            ],
            [
                'name' => 'casual_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => null,
                'description' => 'casual_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 20,
                'maximum_allowed_days' => 10
            ],
            //            [
            //                'name' => 'public_and_govt_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'public_and_govt_leave_description',
            //                'created_at' => $now,
            //            ],
            //            [
            //                'name' => 'public_leave',
            //                'is_parent' => false,
            //                'parent_id' => 11,
            //                'description' => 'public_leave_description',
            //                'created_at' => $now,
            //            ],
            //            [
            //                'name' => 'govt_leave',
            //                'is_parent' => false,
            //                'parent_id' => 11,
            //                'description' => 'govt_leave_description',
            //                'created_at' => $now,
            //            ],
            [
                'name' => 'optional_leave',
                'is_parent' => false,
                'parent_id' => 11,
                'mother_type_id' => null,
                'description' => 'optional_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 3,
                'maximum_allowed_days' => 3
            ],
            [
                'name' => 'rest_and_recreation_leave',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 1,
                'description' => 'rest_and_recreation_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 15,
                'maximum_allowed_days' => 15
            ],
            [
                'name' => 'special_disability_leave_full_pay',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 1,
                'description' => 'special_disability_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 120,
                'maximum_allowed_days' => 120
            ],
            [
                'name' => 'special_disability_leave_half_pay',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 2,
                'description' => 'special_disability_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 600,
                'maximum_allowed_days' => 600
            ],
            //            [
            //                'name' => 'special_sick_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'special_sick_leave_description',
            //                'created_at' => $now,
            //            ],
            //            [
            //                'name' => 'vacation_dept_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'vacation_dept_leave_description',
            //                'created_at' => $now,
            //            ],
            //            [
            //                'name' => 'dept_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'dept_leave_description',
            //                'created_at' => $now,
            //            ],
            [
                'name' => 'hospital_leave_full_pay',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 1,
                'description' => 'hospital_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 90,
                'maximum_allowed_days' => 90
            ],
            [
                'name' => 'hospital_leave_half_pay',
                'is_parent' => true,
                'parent_id' => null,
                'mother_type_id' => 2,
                'description' => 'hospital_leave_description',
                'created_at' => $now,
                'updated_at' => $now,
                'amount' => 90,
                'maximum_allowed_days' => 90
            ],
            //            [
            //                'name' => 'compulsory_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'compulsory_leave_description',
            //                'created_at' => $now,
            //            ],
            //            [
            //                'name' => 'without_pay_leave',
            //                'is_parent' => true,
            //                'parent_id' => null,
            //                'description' => 'without_pay_leave_description',
            //                'created_at' => $now,
            //            ],
        ]);
    }
}
