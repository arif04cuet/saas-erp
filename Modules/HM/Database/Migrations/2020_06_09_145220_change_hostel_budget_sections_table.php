<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHostelBudgetSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->removeColumn('name');
        Schema::table('hostel_budget_sections', function (Blueprint $table) {
            $table->string('title_english')->after('id');
            $table->string('title_bangla')->after('title_english');
            $table->boolean('show_in_report')
                ->nullable()->after('title_bangla');
            $table->string('show_as')
                ->nullable()->after('show_in_report');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->removeColumn('title_english');
        $this->removeColumn('title_bangla');
        $this->removeColumn('show_in_report');
        $this->removeColumn('show_as');
        Schema::table('hostel_budget_sections', function (Blueprint $table) {
            $table->string('name')->after( 'id');
        });
    }

    private function removeColumn($columnName)
    {
        if (Schema::hasColumn('hostel_budget_sections', $columnName)) {
            Schema::table('hostel_budget_sections', function (Blueprint $table) use ($columnName) {
                $table->dropColumn($columnName);
            });
        }

    }
}
