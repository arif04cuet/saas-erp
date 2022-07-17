<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_requisition_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requisition_id')->nullable(false)->unsigned();
            $table->integer('medicine_id')->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->foreign('requisition_id','fk_mrd_requisition_id')->references('id')->on('medicine_requisitions')->onDelete('cascade');
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
        Schema::table('medicine_requisition_details', function (Blueprint $table) {
            $table->dropForeign('fk_mrd_requisition_id');
        });
        Schema::dropIfExists('medicine_requisition_details');

    }
}
