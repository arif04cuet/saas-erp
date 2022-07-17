<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassColumnIntoAppraisalContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appraisal_contents', function (Blueprint $table) {
            $table->enum('class', ['first', 'second', 'third', 'fourth'])->default('fourth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appraisal_contents', function (Blueprint $table) {
            $table->dropColumn('class');
        });
    }
}
