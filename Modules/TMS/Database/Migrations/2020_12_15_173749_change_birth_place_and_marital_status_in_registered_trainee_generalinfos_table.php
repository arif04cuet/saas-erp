<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBirthPlaceAndMaritalStatusInRegisteredTraineeGeneralinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('registered_trainee_generalinfos', 'birth_place')) {
            Schema::table('registered_trainee_generalinfos', function (Blueprint $table) {
                $table->string('birth_place')->nullable()->change();
            });
        }
        if (Schema::hasColumn('registered_trainee_generalinfos', 'marital_status')) {
            Schema::table('registered_trainee_generalinfos', function (Blueprint $table) {
                $table->string('marital_status')->nullable()->change();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('registered_trainee_generalinfos', 'birth_place')) {
            Schema::table('registered_trainee_generalinfos', function (Blueprint $table) {
                $table->string('birth_place')->nullable(false)->change();
            });
        }
        if (Schema::hasColumn('registered_trainee_generalinfos', 'marital_status')) {
            Schema::table('registered_trainee_generalinfos', function (Blueprint $table) {
                $table->string('marital_status')->nullable(false)->change();
            });
        }
    }
}
