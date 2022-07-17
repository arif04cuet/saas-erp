<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchProposalSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_proposal_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('research_request_id');
            $table->integer('auth_user_id');
            $table->text('title');
            $table->string('attachments');
            $table->enum('status', ['PENDING', 'REJECTED', 'APPROVED'])->default('PENDING');
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
        Schema::dropIfExists('research_proposal_submissions');
    }
}
