<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValueToHostelBudgetTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hostel_budget_titles', function (Blueprint $table) {
            $table->string('status')->default(0)->change()->comment('0= not budget yet, 1=approved, 2=rejected, 3=pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hostel_budget_titles', function (Blueprint $table) {
            $table->string('status')->comment('1=approved, 2=rejected, 3=pending')->after('current_year')->nullable()->change();

        });
    }
}
