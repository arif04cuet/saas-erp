<?php

use Illuminate\Database\Seeder;

class TrainingParticipantTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('training_participant_types')->delete();

        \DB::table('training_participant_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'Officials of BCS (Health)',
                    'label' => 'Officials of BCS (Health)',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'title' => 'FTC Trainees from Different Training Institutions',
                    'label' => 'FTC Trainees from Different Training Institutions',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            2 =>
                array (
                    'id' => 3,
                    'title' => 'CSOs',
                    'label' => 'PSOs',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            3 =>
                array (
                    'id' => 4,
                    'title' => 'BGDCL Officials',
                    'label' => 'BGDCL Offcials',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            4 =>
                array (
                    'id' => 5,
                    'title' => 'Elected Commissioners',
                    'label' => 'Elected Commissioners',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            5 =>
                array (
                    'id' => 6,
                    'title' => 'MLG Officials',
                    'label' => 'MLG Officials',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            6 =>
                array (
                    'id' => 7,
                    'title' => 'Union Parishad Secretaries',
                    'label' => 'Union Parishad Secretaries',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            7 =>
                array (
                    'id' => 8,
                    'title' => 'Bangladesh Bank Officials',
                    'label' => 'Bangladesh Bank Officials',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            8 =>
                array (
                    'id' => 9,
                    'title' => 'Information Service Providers',
                    'label' => 'Information Service Providers',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));
    }
}
