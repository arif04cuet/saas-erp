<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishedResearchPaperAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_research_paper_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('published_research_paper_id');
            $table->string('attachment');
            $table->string('file_name');
            $table->enum('type', ['workorder', 'book'])->default('workorder');
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
        Schema::dropIfExists('published_research_paper_attachments');
    }
}
