<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpfConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpf_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gpf_interest_percentage');
            $table->integer('gpf_loan_interest_percentage');
            $table->integer('min_gpf_percentage');
            $table->integer('max_gpf_percentage');
            $table->integer('max_loan_installment')->nullable();
            $table->tinyInteger('status');
            $table->string('remark')->nullable();

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
        Schema::dropIfExists('gpf_configurations');
    }
}
