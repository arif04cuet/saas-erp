<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('file_name');
            $table->text('file_path');
            $table->unsignedInteger('complaint_attachmentable_id');
            $table->string('complaint_attachmentable_type');
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
        Schema::dropIfExists('complaint_attachments');
    }
}
