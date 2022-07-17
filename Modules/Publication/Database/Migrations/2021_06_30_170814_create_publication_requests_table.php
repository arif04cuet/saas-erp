<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('research_id');
            $table->enum('status', ['pending', 'approved', 'rejected', 'send_back', 'on_press', 'completed']);
            $table->text('remark')->nullable();
            $table->text('researcher_remark')->nullable();
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
        Schema::dropIfExists('publication_requests');
    }
}
