<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCertificateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('training_certificate_links')) {
            Schema::create('training_certificate_links', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('trainee_id')->nullable(false);
                $table->unsignedInteger('training_id')->nullable(false);
                $table->string('unique_code')->nullable();
                $table->string('public_link')->nullable();
                $table->boolean('verified')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('training_certificate_links')) {
            Schema::dropIfExists('training_certificate_links');
        }
    }
}
