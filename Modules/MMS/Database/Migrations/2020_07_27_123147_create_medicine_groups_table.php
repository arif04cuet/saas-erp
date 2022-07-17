<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('medicine_groups');
        Schema::create('medicine_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('medicines', function(Blueprint $table)
//        {
//            $table->dropForeign('fk_medicine_group_id');
//        });
        Schema::dropIfExists('medicine_groups');
    }
}
