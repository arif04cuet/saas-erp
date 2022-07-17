<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventory_locations'))
        {
            Schema::create('inventory_locations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->unsignedInteger('department_id')->nullable();
                $table->enum('type', ['store', 'general']);
                $table->text('description')->nullable();
                $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('locations');
        Schema::dropIfExists('inventory_locations');
    }
}
