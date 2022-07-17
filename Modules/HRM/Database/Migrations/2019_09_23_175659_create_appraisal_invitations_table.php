<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('memorandum_no');
            $table->string('title');
            $table->unsignedInteger('appraisal_setting_id');
            $table->dateTime('deadline_to_signer');
            $table->dateTime('deadline_to_final_commenter');
            $table->dateTime('deadline_final_commenter_sign');
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
        Schema::dropIfExists('appraisal_invitations');
    }
}
