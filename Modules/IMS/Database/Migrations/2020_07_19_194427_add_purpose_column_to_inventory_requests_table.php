<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurposeColumnToInventoryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('inventory_requests', 'purpose')) {
            Schema::table('inventory_requests', function (Blueprint $table) {
                $table->string('purpose', 20)->after('type')
                    ->default(config('constants.inventory_request_purposes')[0]);
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
        if (Schema::hasColumn('inventory_requests', 'purpose')) {
            Schema::table('inventory_requests', function (Blueprint $table) {
                $table->dropColumn('purpose');
            });
        }
    }
}
