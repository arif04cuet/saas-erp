<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaNameColumnInRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('room_types', 'bangla_name')) {
            Schema::table('room_types', function (Blueprint $table) {
                $table->string('bangla_name')->after('name')->nullable();
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
        if (Schema::hasColumn('room_types', 'bangla_name')) {
            Schema::table('room_types', function (Blueprint $table) {
                $table->dropColumn('bangla_name');
            });
        }
    }
}
