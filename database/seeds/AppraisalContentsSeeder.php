<?php

use Illuminate\Database\Seeder;

class AppraisalContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('appraisal_contents')->delete();

        \DB::table('appraisal_contents')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'intelligence_emotional_alert',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'workshop',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),

            2 =>
                array(
                    'id' => 3,
                    'name' => 'express_power_verbal',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'initiative',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'amount_of_work',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'quality_of_work',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'cooperation',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'interest_of_work',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'practice_sincerity',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'aspect_of_uracy',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'accept_suggestions_of_supreme',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => 'responsibility',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'honesty',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'clean_behavior',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'health',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'office_presence',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'behavior',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => 'co_workers_relationship',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'interest_in_using_bengali_language',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => 'liverage_wear_office_attendance',
                    'class' => 'fourth',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => 'intelligence_emotional_alert',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => 'workshop',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),

            22 =>
                array(
                    'id' => 23,
                    'name' => 'behavior',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            23 =>
                array(
                    'id' => 24,
                    'name' => 'initiative',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            24 =>
                array(
                    'id' => 25,
                    'name' => 'amount_of_work',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            25 =>
                array(
                    'id' => 26,
                    'name' => 'quality_of_work',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            26 =>
                array(
                    'id' => 27,
                    'name' => 'cooperation',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            27 =>
                array(
                    'id' => 28,
                    'name' => 'interest_of_work',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            28 =>
                array(
                    'id' => 29,
                    'name' => 'practice_sincerity',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            29 =>
                array(
                    'id' => 30,
                    'name' => 'aspect_of_uracy_2',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            30 =>
                array(
                    'id' => 31,
                    'name' => 'accept_suggestions_of_supreme_2',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            31 =>
                array(
                    'id' => 32,
                    'name' => 'responsibility',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            32 =>
                array(
                    'id' => 33,
                    'name' => 'honesty',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            33 =>
                array(
                    'id' => 34,
                    'name' => 'clean_behavior',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            34 =>
                array(
                    'id' => 35,
                    'name' => 'health_2',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            35 =>
                array(
                    'id' => 36,
                    'name' => 'office_presence',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            36 =>
                array(
                    'id' => 37,
                    'name' => 'express_power_verbal',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            37 =>
                array(
                    'id' => 38,
                    'name' => 'co_workers_relationship',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            38 =>
                array(
                    'id' => 39,
                    'name' => 'dedication_towards_organization',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            39 =>
                array(
                    'id' => 40,
                    'name' => 'interest_in_using_bengali_language_2',
                    'class' => 'third',
                    'type' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            40 =>
                array(
                    'id' => 41,
                    'name' => 'discipline',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            41 =>
                array(
                    'id' => 42,
                    'name' => 'knowledge_of_judgement_and_dimension',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),

            42 =>
                array(
                    'id' => 43,
                    'name' => 'intelligence',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            43 =>
                array(
                    'id' => 44,
                    'name' => 'initiative',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            44 =>
                array(
                    'id' => 45,
                    'name' => 'cooperation',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            45 =>
                array(
                    'id' => 46,
                    'name' => 'cleanliness_in_conduct',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            46 =>
                array(
                    'id' => 47,
                    'name' => 'relationship_with_colleagues_and_the_public',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            47 =>
                array(
                    'id' => 48,
                    'name' => 'personality',
                    'class' => 'first',
                    'type' => 'personal_features',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            48 =>
                array(
                    'id' => 49,
                    'name' => 'professional_knowledge',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            49 =>
                array(
                    'id' => 50,
                    'name' => 'amount_of_work_performed',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            50 =>
                array(
                    'id' => 51,
                    'name' => 'quality_of_work',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            51 =>
                array(
                    'id' => 52,
                    'name' => 'timeliness',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            52 =>
                array(
                    'id' => 53,
                    'name' => 'questionnaire_1',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            53 =>
                array(
                    'id' => 54,
                    'name' => 'questionnaire_2',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            54 =>
                array(
                    'id' => 55,
                    'name' => 'questionnaire_3',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            55 =>
                array(
                    'id' => 56,
                    'name' => 'questionnaire_4',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            56 =>
                array(
                    'id' => 57,
                    'name' => 'questionnaire_5',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            57 =>
                array(
                    'id' => 58,
                    'name' => 'questionnaire_6',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            58 =>
                array(
                    'id' => 59,
                    'name' => 'questionnaire_7',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            59 =>
                array(
                    'id' => 60,
                    'name' => 'questionnaire_8',
                    'class' => 'first',
                    'type' => 'performance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
        ));
    }
}
