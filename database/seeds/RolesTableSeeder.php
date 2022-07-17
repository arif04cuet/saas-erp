<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('spatie_roles')->delete();

        DB::table('spatie_roles')->insert(array(
            0 =>
            array(
                'name' => 'ROLE_DIRECTOR_GENERAL',
                'description' => 'Has general admin role',
                'created_at' => null,
                'updated_at' => null,
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'ROLE_DIRECTOR_ADMIN',
                'description' => 'Has admin role',
                'created_at' => null,
                'updated_at' => null,
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'ROLE_DIRECTOR_TRAINING',
                'description' => 'Has Training access',
                'created_at' => null,
                'updated_at' => null,
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'ROLE_HOSTEL_MANAGER',
                'description' => 'Has hostel access',
                'created_at' => null,
                'updated_at' => null,
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'ROLE_RESEARCH_DIRECTOR',
                'description' => 'Has research access',
                'created_at' => null,
                'updated_at' => null,
            ),
            5 =>
            array(
                'id' => 6,
                'name' => 'ROLE_FACULTY',
                'description' => 'Has faculty access',
                'created_at' => null,
                'updated_at' => null,
            ),
            6 =>
            array(
                'id' => 7,
                'name' => 'ROLE_PROJECT_DIRECTOR',
                'description' => 'Has project access',
                'created_at' => null,
                'updated_at' => null,
            ),
            7 =>
            array(
                'id' => 8,
                'name' => 'ROLE_DIRECTOR_PROJECT',
                'description' => 'Has project access',
                'created_at' => null,
                'updated_at' => null,
            ),
            8 =>
            array(
                'id' => 9,
                'name' => 'ROLE_DEPARTMENT_HEAD',
                'description' => 'DEPARTMENT HEAD',
                'created_at' => null,
                'updated_at' => null,
            ),
            9 =>
            array(
                'id' => 10,
                'name' => 'ROLE_INVENTORY_REQUEST_SHARE',
                'description' => 'Can share inventory requests.',
                'created_at' => null,
                'updated_at' => null,
            ),
            10 =>
            array(
                'id' => 11,
                'name' => 'ROLE_INVENTORY_REQUEST_APPROVE',
                'description' => 'Can approve inventory requests.',
                'created_at' => null,
                'updated_at' => null,
            ),
            11 =>
            array(
                'id' => 12,
                'name' => 'ROLE_INVENTORY_REQUEST_REJECT',
                'description' => 'Can reject inventory requests.',
                'created_at' => null,
                'updated_at' => null,
            ),
            12 =>
            array(
                'id' => 13,
                'name' => 'ROLE_INVENTORY_REQUEST_RECEIVE',
                'description' => 'Can receive inventory requests.',
                'created_at' => null,
                'updated_at' => null,
            ),
            13 =>
            array(
                'id' => 14,
                'name' => 'ROLE_INVENTORY_USER',
                'description' => 'This is defines that the user belongs to main store section.',
                'created_at' => null,
                'updated_at' => null,
            ),
            14 =>
            array(
                'id' => 15,
                'name' => 'ROLE_CAFETERIA_MANAGER',
                'description' => 'This is defines that the user belongs to cafeteria manager',
                'created_at' => null,
                'updated_at' => null,
            ),
            15 =>
            array(
                'id' => 16,
                'name' => 'ROLE_VMS_LINE_MANAGER',
                'description' => 'Trip Request, Fuel Bill Submission goes to this user ',
                'created_at' => null,
                'updated_at' => null,
            ),
            16 =>
            array(
                'id' => 17,
                'name' => 'ROLE_VMS_MECHANIC',
                'description' => 'Vehicle Maintenance Submission goes to this user ',
                'created_at' => null,
                'updated_at' => null,
            ),
            17 =>
            array(
                'id' => 18,
                'name' => 'ROLE_DOCTOR',
                'description' => 'MMS Module doctor list',
                'created_at' => null,
                'updated_at' => null,
            ),
            18 =>
            array(
                'id' => 19,
                'name' => 'ROLE_HRM_SECTION_OFFICER',
                'description' => 'HRM Section Officer',
                'created_at' => null,
                'updated_at' => null,
            ),
            19 =>
            array(
                'id' => 20,
                'name' => 'ROLE_PUBLIC_USER',
                'description' => 'Public Registration User',
                'created_at' => null,
                'updated_at' => null,
            ),

        ));
    }
}
