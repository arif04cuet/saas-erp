<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_course_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type');
            $table->string('registration')->nullable();
            $table->decimal('registration_amt')->nullable();
            $table->string('exam')->nullable();
            $table->decimal('exam_amt')->nullable();
            $table->string('certificate_widraw')->nullable();
            $table->decimal('certificate_widraw_amt')->nullable();
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
        Schema::dropIfExists('training_course_payments');
    }
};
