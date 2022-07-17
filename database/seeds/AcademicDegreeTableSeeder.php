<?php

    use Illuminate\Database\Seeder;

    class AcademicDegreeTableSeeder extends Seeder
    {

        /**
         * Auto generated seed file
         *
         * @return void
         */
        public function run()
        {


            \DB::table('academic_degree')->delete();

            \DB::table('academic_degree')->insert(array (
                0 =>
                    array (
                        'id' => 1,
                        'name' => 'Academic Degree 1',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                    ),
                1 =>
                    array (
                        'id' => 2,
                        'name' => 'Academic Degree 2',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                    ),

                2 =>
                    array (
                        'id' => 3,
                        'name' => 'Academic Degree 3',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                    ),
            ));
        }
    }