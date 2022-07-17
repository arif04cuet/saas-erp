<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestedFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('physical_facility_request_id');
            $table->string('facility_type');
            $table->integer('reference_table_id');
            $table->date('book_from');
            $table->date('book_to');
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
        Schema::dropIfExists('requested_facilities');
    }
}
