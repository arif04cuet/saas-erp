<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'doptor_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->bigInteger('doptor_id')->after('user_type')->nullable();
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

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'doptor_id')) {
                $table->dropColumn('doptor_id');
            }
        });
    }
};
