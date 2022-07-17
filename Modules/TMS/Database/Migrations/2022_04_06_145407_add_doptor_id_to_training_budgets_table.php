<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_budgets', function (Blueprint $table) {
            $table->bigInteger('doptor_id')->after('name_bangla')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_budgets', function (Blueprint $table) {
            $table->dropColumn('doptor_id');
        });
    }
};
