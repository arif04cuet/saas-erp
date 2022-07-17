<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishedResearchPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_research_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('publication_type_id');
            $table->unsignedInteger('publication_press_id');
            $table->unsignedInteger('publication_request_id');
            $table->integer('quantity');
            $table->enum('proof_status', array_keys(config('publication.proof_status')));
            $table->enum('status', array_keys(config('publication.status')));
            $table->text('remark')->nullable();

            $table->foreign('publication_type_id')->references('id')->on('publication_types')->onDelete('cascade');
            $table->foreign('publication_press_id')->references('id')->on('publication_presses')->onDelete('cascade');
            $table->foreign('publication_request_id')->references('id')->on('publication_requests')->onDelete('cascade');
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
        Schema::dropIfExists('published_research_papers');
    }
}
