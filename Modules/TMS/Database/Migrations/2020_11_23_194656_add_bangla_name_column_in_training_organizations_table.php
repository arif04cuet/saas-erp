<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaNameColumnInTrainingOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('training_organizations', 'bangla_name')) {
            Schema::table('training_organizations', function (Blueprint $table) {
                $table->string('bangla_name')->after('name')->nullable(true);
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
        if (Schema::hasColumn('training_organizations', 'bangla_name')) {
            Schema::table('training_organizations', function (Blueprint $table) {
                $table->dropColumn('bangla_name');
            });
        }
    }
}
