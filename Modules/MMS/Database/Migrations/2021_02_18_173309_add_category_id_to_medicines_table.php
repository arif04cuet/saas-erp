<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('medicines', 'category_id')) {
            Schema::table('medicines', function (Blueprint $table) {
                $table->integer('category_id')->nullable()->after('company_name');
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
        if (Schema::hasColumn('medicines', 'category_id')) {
            Schema::table('medicines', function (Blueprint $table) {
                $table->dropColumn('category_id');
            });
        }
    }
}
