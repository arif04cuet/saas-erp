<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id');
            $table->integer('ref_table_id');//Feature item it
            $table->integer('request_ref_id')->nullable();//For example - which workflow
            $table->boolean('is_group_notification')->default(true);
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('to_user_id')->nullable();
            $table->integer('from_user_id');
            $table->string('message');
            $table->string('status')->default('ACTIVE');

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
        Schema::dropIfExists('share_conversations');
    }
}
