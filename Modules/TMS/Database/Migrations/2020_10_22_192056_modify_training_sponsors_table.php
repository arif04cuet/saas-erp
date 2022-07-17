<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTrainingSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('training_sponsors', 'training_id')) {
            Schema::table('training_sponsors', function (Blueprint $table) {
                $table->unsignedInteger('training_id')->nullable()->change();
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
        if (Schema::hasColumn('training_sponsors', 'training_id')) {
            Schema::table('training_sponsors', function (Blueprint $table) {
                $table->unsignedInteger('training_id')->nullable(false)->change();
            });
        }
    }
}
