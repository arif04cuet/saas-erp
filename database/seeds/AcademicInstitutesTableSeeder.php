<?php

    use Illuminate\Database\Seeder;

    class AcademicInstitutesTableSeeder extends Seeder
    {

        /**
         * Auto generated seed file
         *
         * @return void
         */
        public function run()
        {


            \DB::table('academic_institutes')->truncate();

            \DB::table('academic_institutes')->insert([
                ['name' => 'National Institute 1', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'National Institute 2', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'National Institute 3', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'National Institute 4', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'National Institute 5', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'National Institute 6', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dhaka', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Rajshahi', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Cumilla', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Jessore', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Chattogram', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Barisal', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Sylhet', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dinajpur', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Madrasah', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ]);


        }
    }