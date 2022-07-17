<?php

use Illuminate\Database\Seeder;

class PensionConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pension_configurations')->insert([
            0 => [
                'title' => 'Default Pension Configuration',
                'status' => \Modules\Accounts\Entities\PensionConfiguration::status[0]
                // all other fields have default in it
            ]
        ]);
    }
}
