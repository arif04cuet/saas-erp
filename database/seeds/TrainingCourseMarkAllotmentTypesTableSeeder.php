<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourseMarkAllotmentType;

class TrainingCourseMarkAllotmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_course_mark_allotment_types')->truncate();

        $this->defaultTypes()->each(function ($type) {
            $createdType = TrainingCourseMarkAllotmentType::create($type);
        });
    }

    private function defaultTypes()
    {
        return collect([
            [
                'title' => 'written_test',
            ],
            [
                'title' => 'book_review_and_presentation',
            ],
            [
                'title' => 'village_study_and_presentation',
            ],
            [
                'title' => 'pt_and_games',
            ],
            [
                'title' => 'class_attendance',
            ],
            [
                'title' => 'library_attendance',
            ],
            [
                'title' => 'evaluation_by_course_management',
            ],
        ]);
    }
}
