<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCategory;

class TrainingCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('training_categories')->truncate();

        $this->defaultTrainingCategories()->each(function($category) {
            TrainingCategory::create($category);
        });
    }

    private function defaultTrainingCategories()
    {
        return collect([
            [
                'slug' => 'training_course',
                'is_parent' => true
            ],
            [
                'slug' => 'training_orientation',
                'is_parent' => true
            ],
            [
                'slug' => 'training_attachment',
                'is_parent' => false
            ],
            [
                'slug' => 'training_conference',
                'is_parent' => false
            ],
            [
                'slug' => 'training_workshop',
                'is_parent' => false
            ],
            [
                'slug' => 'training_seminar',
                'is_parent' => false
            ],
            [
                'slug' => 'training_course_foundation',
                'is_parent' => true,
                'parent_id' => 1,
            ],
            [
                'slug' => 'training_course_project',
                'is_parent' => true,
                'parent_id' => 1,
            ],
            [
                'slug' => 'training_course_self_initiated',
                'is_parent' => true,
                'parent_id' => 1,
            ],
            [
                'slug' => 'training_course_organization_demand',
                'is_parent' => true,
                'parent_id' => 1,
            ],
            [
                'slug' => 'training_course_foundation_regular',
                'is_parent' => false,
                'parent_id' => 7,
            ],
            [
                'slug' => 'training_course_foundation_special',
                'is_parent' => false,
                'parent_id' => 7,
            ],
            [
                'slug' => 'training_course_project_internal',
                'is_parent' => false,
                'parent_id' => 8,
            ],
            [
                'slug' => 'training_course_project_external',
                'is_parent' => false,
                'parent_id' => 8,
            ],
        ]);
    }
}
