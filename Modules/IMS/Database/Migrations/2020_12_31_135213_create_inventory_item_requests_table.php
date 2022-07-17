<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('inventory_item_requests')) {
            Schema::create('inventory_item_requests', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('requester_id');
                $table->unsignedInteger('inventory_location_id');
                $table->string('uid')->nullable(); // a random unique number
                $table->string('title');
                $table->string('purpose')->default('others');
                $table->text('reason')->nullable();
                $table->string('reference_entity')->nullable();
                $table->unsignedInteger('reference_entity_id')->nullable();
                $table->string('status')->default('new'); // this has a workflow ['new','pending','shared','approved','received','rejected']
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
        Schema::dropIfExists('inventory_item_requests');
    }
}
