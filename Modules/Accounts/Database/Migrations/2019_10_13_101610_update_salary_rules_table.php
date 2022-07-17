<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSalaryRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('salary_rules','min_amount'))
        {
            Schema::table('salary_rules', function (Blueprint $table) {
                $table->float('min_amount')->nullable()->after('percentage');
                $table->float('max_amount')->nullable()->after('min_amount');
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
        if(Schema::hasColumn('salary_rules','min_amount')) {
            Schema::table('salary_rules', function (Blueprint $table) {
                $table->dropColumn('min_amount');
                $table->dropColumn('max_amount');
            });
        }
    }
}
