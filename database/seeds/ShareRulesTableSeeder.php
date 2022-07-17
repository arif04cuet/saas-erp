<?php

use Illuminate\Database\Seeder;

class ShareRulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('share_rules')->delete();

        \DB::table('share_rules')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Research Brief Sharing Rule - Director research will share with, ADR, JD, DDR, DG and ADG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Project Sharing Rule, Director project with ADP, JD, DDR, DG, DA and ADG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'ADR will share with DR and JDR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'JDR can share with DR, ADR, DDR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'DDR can share with JDP and DR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'DG can share with DR and ADG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'ADG can share with DG and DR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'ADP will share with PD and JDP',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'JDP can share with PD, ADP, DDP',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'DDP can share with JDP and PD',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'ADG can share with PD and DG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => 'DG can share with ADG and PD',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'DR * Research Details Sharing Rule - Director research will share with, ADR, JD, DDR, DG and ADG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'Project Detail Sharing Rule, Director project with ADP, JD, DDR, DG, DA and ADG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'ADR will share with DR and JDR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'JDR can share with DR, ADR, DDR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'DDR can share with JDR and DR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => 'DG can share with DR and ADG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'ADG can share with DG and DR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => 'ADP will share with PD and JDP',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => 'JDP can share with PD, ADP, DDP',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => 'DDP can share with JDP and PD',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            22 =>
                array(
                    'id' => 23,
                    'name' => 'ADG can share with PD and DG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            23 =>
                array(
                    'id' => 24,
                    'name' => 'DG can share with ADG and PD',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            24 =>
                array(
                    'id' => 25,
                    'name' => 'DR Can Share With Any Employee',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            25 =>
                array(
                    'id' => 26,
                    'name' => 'Any Employee Can Share with DR',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            26 =>
                array(
                    'id' => 27,
                    'name' => 'DR Can Share with DG',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            // DA(brief)->DIRP
            27 =>
                array(
                    'id' => 28,
                    'name' => 'DA(brief) Can Share with DIRP',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            // DA(details)->DIRP
            28 =>
                array(
                    'id' => 29,
                    'name' => 'DA(details) Can Share with DIRP',
                    'is_group' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                )
        ));


    }
}