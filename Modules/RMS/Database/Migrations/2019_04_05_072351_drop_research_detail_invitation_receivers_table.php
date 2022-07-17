<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropResearchDetailInvitationReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('research_detail_invitation_receivers');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::create('research_detail_invitation_receivers', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->timestamps();
//        });
    }
}
