<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishedResearchPaperCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_research_paper_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('published_research_paper_id');
            $table->string('action');
            $table->text('remark');
            $table->dateTime('last_date')->nullable()->default(null);
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
        Schema::dropIfExists('published_research_paper_comments');
    }
}
