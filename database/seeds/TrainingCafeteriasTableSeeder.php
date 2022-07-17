<?php

use Illuminate\Database\Seeder;
use Modules\TMS\Entities\TrainingCafeteria;

class TrainingCafeteriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_cafeterias')->truncate();

        $this->defaultTrainingCafeterias()->each(function($category) {
            TrainingCafeteria::create($category);
        });
    }

    private function defaultTrainingCafeterias()
    {
        return collect([
            [
                'name' => 'Cafeteria 1',
                'short_code' => 'CAF 1',
                'capacity' => 200
            ],
            [
                'name' => 'Cafeteria 2',
                'short_code' => 'CAF 2',
                'capacity' => 200
            ],
            [
                'name' => 'Cafeteria 3',
                'short_code' => 'CAF 3',
                'capacity' => 200
            ],
        ]);
    }
}
