<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('published_research_paper_id');
            $table->unsignedInteger('available_amount');
            $table->unsignedInteger('previous_amount');
            //$table->foreign('published_research_paper_id')->references('id')->on('publications')->onDelete('cascade');
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
        Schema::dropIfExists('publication_inventories');
    }
}
