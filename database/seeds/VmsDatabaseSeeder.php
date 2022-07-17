<?php

use Illuminate\Database\Seeder;

class VmsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VehicleTypeSeeder::class);
        $this->call(RolesTableSeeder::class);

    }
}
