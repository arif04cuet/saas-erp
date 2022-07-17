<?php

use Illuminate\Database\Seeder;

class FiscalYearsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('fiscal_years')->delete();
        \DB::table('fiscal_years')->insert([
            0 => [
                'name' => '2017-2018',
                'start' => new \Carbon\Carbon('2017-07-01'),
                'end' => new \Carbon\Carbon('2018-06-30')
            ],
            1 => [
                'name' => '2018-2019',
                'start' => new \Carbon\Carbon('2018-07-01'),
                'end' => new \Carbon\Carbon('2019-06-30')
            ],
            2 => [
                'name' => '2019-2020',
                'start' => new \Carbon\Carbon('2019-07-01'),
                'end' => new \Carbon\Carbon('2020-06-30')
            ],
            3 => [
                'name' => '2020-2021',
                'start' => new \Carbon\Carbon('2020-07-01'),
                'end' => new \Carbon\Carbon('2021-06-30')
            ],
            4 => [
                'name' => '2021-2022',
                'start' => new \Carbon\Carbon('2021-07-01'),
                'end' => new \Carbon\Carbon('2022-06-30')
            ],
            5 => [
                'name' => '2022-2023',
                'start' => new \Carbon\Carbon('2022-07-01'),
                'end' => new \Carbon\Carbon('2023-06-30')
            ],
            6 => [
                'name' => '2023-2024',
                'start' => new \Carbon\Carbon('2023-07-01'),
                'end' => new \Carbon\Carbon('2024-06-30')
            ],
            7 => [
                'name' => '2024-2025',
                'start' => new \Carbon\Carbon('2024-07-01'),
                'end' => new \Carbon\Carbon('2025-06-30')
            ],
            8 => [
                'name' => '2025-2026',
                'start' => new \Carbon\Carbon('2025-07-01'),
                'end' => new \Carbon\Carbon('2026-06-30')
            ],
            9 => [
                'name' => '2026-2027',
                'start' => new \Carbon\Carbon('2026-07-01'),
                'end' => new \Carbon\Carbon('2027-06-30')
            ],
            10 => [
                'name' => '2027-2028',
                'start' => new \Carbon\Carbon('2027-07-01'),
                'end' => new \Carbon\Carbon('2028-06-30')
            ],
            11 => [
                'name' => '2028-2029',
                'start' => new \Carbon\Carbon('2028-07-01'),
                'end' => new \Carbon\Carbon('2029-06-30')
            ],
            12 => [
                'name' => '2029-2030',
                'start' => new \Carbon\Carbon('2029-07-01'),
                'end' => new \Carbon\Carbon('2030-06-30')
            ],


        ]);


    }
}
