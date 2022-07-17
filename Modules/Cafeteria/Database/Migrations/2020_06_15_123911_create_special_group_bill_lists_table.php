<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialGroupBillListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_group_bill_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('special_group_bill_id');
            $table->date('bill_date');
            $table->integer('member');
            $table->integer('charge');
            $table->integer('total_charge');
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
        Schema::dropIfExists('special_group_bill_lists');
    }
}
