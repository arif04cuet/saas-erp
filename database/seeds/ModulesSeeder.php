<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name_en' => 'Training Management System',
                'name_bn' => 'Training Management System',
                'slug' => 'tms',
                'short_code' => 'TMS',
                'status' => 1
            ],
            [
                'name_en' => 'Hostel Management System',
                'name_bn' => 'Hostel Management System',
                'slug' => 'hm',
                'short_code' => 'HM',
                'status' => 1
            ],
            [
                'name_en' => 'Cafeteria Management System',
                'name_bn' => 'Cafeteria Management System',
                'slug' => 'cafeteria',
                'short_code' => 'Cafeteria',
                'status' => 1
            ],
            [
                'name_en' => 'Inventory Management System',
                'name_bn' => 'Inventory Management System',
                'slug' => 'ims',
                'short_code' => 'IMS',
                'status' => 1
            ]
        ];

        Module::insert($modules);
    }
}
