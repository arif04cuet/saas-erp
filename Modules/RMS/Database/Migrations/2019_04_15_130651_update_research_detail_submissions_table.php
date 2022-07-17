<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateResearchDetailSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('research_detail_submissions', function (Blueprint $table) {
            $table->integer('research_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('research_detail_submissions', 'research_id'))
        {
            Schema::table('research_detail_submissions', function (Blueprint $table) {
                $table->dropColumn('research_id');
            });
        }
    }
}
