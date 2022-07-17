<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEconomyHeadIdColumnToEconomyHeadCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('economy_codes', function (Blueprint $table) {
            $table->renameColumn('economy_head_id', 'economy_head_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('economy_codes', function (Blueprint $table) {
            $table->renameColumn('economy_head_code', 'economy_head_id');
        });
    }
}
