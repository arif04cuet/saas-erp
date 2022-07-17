<?php

use Illuminate\Database\Seeder;

class AssessmentQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('assessment_questions')->delete();
        \DB::table('assessment_question_types')->delete();
        \DB::table('assessment_question_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Positive Quality',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

        ));
        \DB::table('assessment_questions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'assessment_question_type_id' => 1,
                    'name' => 'Use of latest Data',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'assessment_question_type_id' => 1,
                    'name' => 'Clear Speech',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'assessment_question_type_id' => 1,
                    'name' => 'Depth of knowledge, effectiveness',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'assessment_question_type_id' => 1,
                    'name' => 'Effective Presentation',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'assessment_question_type_id' => 1,
                    'name' => 'Use of appropriate words',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'assessment_question_type_id' => 1,
                    'name' => 'Use of appropriate training methods',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

        ));
    }
}
