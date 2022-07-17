<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateResearchRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('research_requests', function (Blueprint $table) {
            $table->dropColumn(['to', 'attachment']);
            $table->enum('status', ['pending', 'in progress', 'reviewed'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('research_requests', function (Blueprint $table) {

        });
    }
}
