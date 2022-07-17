<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchDetailInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_detail_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->dateTime('end_date');
            $table->text('remarks')->nullable();
            $table->enum('status', ['pending', 'in progress', 'reviewed'])->default('pending');
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
        Schema::dropIfExists('research_detail_invitations');
    }
}
