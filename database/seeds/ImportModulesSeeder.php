<?php

namespace Database\Seeders;

use App\Models\Module as DBModule;
use Illuminate\Database\Seeder;
use Module;

class ImportModulesSeeder extends Seeder
{
    public function run()
    {
        Module::collections()
            ->keys()
            ->each(function ($short_name) {

                $slug = strtolower($short_name);

                app()->setLocale('en');
                $name_en = trans('labels.' . $short_name);

                app()->setLocale('bn');
                $name_bn = trans('labels.' . $short_name);

                DBModule::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name_bn' => $name_bn,
                        'name_en' => $name_en,
                        'short_code' => $short_name,
                        'status' => 1
                    ]
                );
            });
    }
}
