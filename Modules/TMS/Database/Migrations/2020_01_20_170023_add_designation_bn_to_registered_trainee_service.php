<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDesignationBnToRegisteredTraineeService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registered_trainee_service', function (Blueprint $table) {
            $table->string('designation_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registered_trainee_service', function (Blueprint $table) {
            if (Schema::hasColumn('registered_trainee_service', 'designation_bn'))
            {
                $table->dropColumn('designation_bn');
            }
        });
    }
}
