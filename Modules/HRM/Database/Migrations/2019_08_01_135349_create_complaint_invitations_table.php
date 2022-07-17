<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('complainer_id');
            $table->unsignedInteger('complainee_id');
            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('reviewer_id')->nullable();
            $table->text('reason');
            $table->enum('status', ['ready', 'approved', 'rejected', 'reviewing', 'submitted'])->default('ready');
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
        Schema::dropIfExists('complaint_invitations');
    }
}
