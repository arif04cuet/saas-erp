<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchPaperFreeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_paper_free_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('published_research_paper_id');
            //$table->foreign('published_research_paper_id')->references('id')->on('publications')->onDelete('cascade');
            $table->integer('requester_id')->nullable();
            $table->enum('reference_type', ['employee', 'organization']);
            $table->unsignedInteger('reference_id');
            $table->enum('application_type', ['manual', 'application']);
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->unsignedInteger('quantity');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_paper_free_requests');
    }
}
