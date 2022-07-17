<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PensionRuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pensionConfiguration = \Modules\Accounts\Entities\PensionConfiguration::first();
        DB::table('pension_rules')->delete();
        // run only if pension Configuration is found
        if ($pensionConfiguration) {
            DB::table('pension_rules')->insert([
                0 => [
                    'pension_configuration_id' => $pensionConfiguration->id,
                    'name' => 'Boishakhi Bonus',
                    'type' => 'bonus',
                    'condition' => 'occasional',
                    'amount_type' => 'percentage_amount',
                    'percentage_amount' => 20,
                    'fixed_amount' => 0,
                ],
                1 => [
                    'pension_configuration_id' => $pensionConfiguration->id,
                    'name' => 'Festival Bonus',
                    'type' => 'bonus',
                    'condition' => 'occasional',
                    'amount_type' => 'percentage_amount',
                    'percentage_amount' => 100,
                    'fixed_amount' => 0,
                ],
            ]);
        }

    }
}
