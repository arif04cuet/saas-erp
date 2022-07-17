<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFathersNameBnAndMothersNameBnAndPresentAddressBnToRegisteredTraineeGeneralInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registered_trainee_generalInfos', function (Blueprint $table) {
            $table->string('fathers_name_bn');
            $table->string('mothers_name_bn');
            $table->string('present_address_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registered_trainee_generalInfos', function (Blueprint $table) {
            if (Schema::hasColumn('registered_trainee_generalInfos', 'fathers_name_bn')) {
                $table->dropColumn('fathers_name_bn');
            }
            if (Schema::hasColumn('registered_trainee_generalInfos', 'mothers_name_bn')) {
                $table->dropColumn('mothers_name_bn');
            }
            if (Schema::hasColumn('registered_trainee_generalInfos', 'present_address_bn')) {
                $table->dropColumn('present_address_bn');
            }
        });
    }
}
