<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            DB::statement("ALTER TABLE complaints CHANGE COLUMN status status ENUM('approved', 'rejected', 'reviewing', 'new', 'checking')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            DB::statement("ALTER TABLE complaints CHANGE COLUMN status status ENUM('approved', 'rejected', 'reviewing', 'new', 'checking')");
        });
    }
}
