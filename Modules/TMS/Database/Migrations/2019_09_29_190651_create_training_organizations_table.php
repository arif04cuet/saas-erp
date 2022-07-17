<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->enum('type', ['public', 'autonomous', 'international', 'private', 'ngo', 'others']);
            $table->text('address')->nullable();
            $table->string('contact_person');
            $table->string('contact_person_email');
            $table->string('contact_person_cc')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('training_organizations');
    }
}
