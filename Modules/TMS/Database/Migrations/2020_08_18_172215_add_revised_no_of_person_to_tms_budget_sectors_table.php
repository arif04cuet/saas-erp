<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevisedNoOfPersonToTmsBudgetSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('tms_budget_sectors', 'revised_no_of_person')) {
            Schema::table('tms_budget_sectors', function (Blueprint $table) {
                $table->tinyInteger('revised_no_of_person')->after('total')->nullable();
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
        if (Schema::hasColumn('tms_budget_sectors', 'revised_no_of_person')) {
            Schema::table('tms_budget_sectors', function (Blueprint $table) {
                $table->dropColumn('revised_no_of_person');
            });
        }
    }
}
