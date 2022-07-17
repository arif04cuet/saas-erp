<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInventoryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_requests', function (Blueprint $table) {
            DB::statement("ALTER TABLE inventory_requests CHANGE COLUMN status status ENUM('new', 'pending', 'shared', 'approved', 'received', 'rejected') NOT NULL DEFAULT 'new'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_requests', function (Blueprint $table) {
            DB::statement("ALTER TABLE inventory_requests CHANGE COLUMN status status ENUM('new', 'pending', 'reviewing', 'approved', 'received', 'rejected') NOT NULL DEFAULT 'new'");
        });
    }
}
