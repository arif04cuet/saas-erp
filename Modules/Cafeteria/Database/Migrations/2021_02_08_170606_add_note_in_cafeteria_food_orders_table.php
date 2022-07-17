<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoteInCafeteriaFoodOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafeteria_food_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('cafeteria_food_orders', 'note')) {
                $table->text('note')->after('remarks')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafeteria_food_orders', function (Blueprint $table) {
            if (Schema::hasColumn('cafeteria_food_orders', 'note')) {
                $table->dropColumn('note');
            }
        });
    }
}
