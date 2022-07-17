<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('leave_type_id');
            $table->unsignedInteger('requester_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('duration');
            $table->text('reason');
            $table->enum('status', ['new', 'pending', 'shared', 'approved', 'rejected'])
                ->default('new');
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
        Schema::dropIfExists('leave_requests');
    }
}
