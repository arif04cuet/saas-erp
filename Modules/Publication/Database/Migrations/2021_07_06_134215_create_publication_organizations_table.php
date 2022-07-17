<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_bn');
            $table->unsignedInteger('organization_head');
            $table->foreign('organization_head')->nullable()->references('id')->on('employees')->onDelete('cascade');
            $table->string('status');
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
        Schema::dropIfExists('publication_organizations');
    }
}
