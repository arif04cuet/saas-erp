<?php

use Illuminate\Database\Seeder;

class InventoryLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('inventory_locations')->delete();

        \DB::table('inventory_locations')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'main store',
                    'department_id' => NULL,
                    'type' => 'store',
                    'description' => 'Main store for BARD.',
                    'is_default' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'scrap location',
                    'department_id' => NULL,
                    'type' => 'general',
                    'description' => 'Scrap location',
                    'is_default' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'abandon location',
                    'department_id' => NULL,
                    'type' => 'general',
                    'description' => 'Abandon location',
                    'is_default' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Inventory Store',
                    'department_id' => 10,
                    'type' => 'store',
                    'description' => 'Inventory Store',
                    'is_default' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Research Dept Store',
                    'department_id' => 1,
                    'type' => 'store',
                    'description' => 'Research Store',
                    'is_default' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'Research General Store',
                    'department_id' => 1,
                    'type' => 'general',
                    'description' => 'Research General Store',
                    'is_default' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'Project Management Store',
                    'department_id' => 2,
                    'type' => 'store',
                    'description' => 'Project management Store',
                    'is_default' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'Administration Store',
                    'department_id' => 9,
                    'type' => 'store',
                    'description' => 'Administration Store',
                    'is_default' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}