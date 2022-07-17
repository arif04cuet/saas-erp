<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id'); //Fixied and hard codded to the constant and table named notification_types
            $table->integer('ref_table_id'); // data item table id for different items on which the action is occured
            $table->integer('from_user_id');
            $table->integer('to_user_id')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('item_url')->default('#');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
