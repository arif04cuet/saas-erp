<?php

    use Illuminate\Database\Seeder;

    class AcademicDepartmentsTableSeeder extends Seeder
    {

        /**
         * Auto generated seed file
         *
         * @return void
         */
        public function run()
        {


            \DB::table('academic_departments')->delete();

            \DB::table('academic_departments')->insert(array (
                0 =>
                    array (
                        'id' => 1,
                        'name' => 'Science Department',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                    ),
                1 =>
                    array (
                        'id' => 2,
                        'name' => 'Commerce Department',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                    ),

                2 =>
                    array (
                        'id' => 3,
                        'name' => 'Arts Department',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                    ),

            ));


        }
    }