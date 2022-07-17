<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameMobileUserTypeReferenceTableIdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username','50')->unique();
            $table->string('user_type', 30)->default(config('user.types.GUEST'));
            $table->string('mobile', 15);
            $table->integer('reference_table_id')->nullable();
            $table->string('status')->default(config('user.status.ACTIVE'));
            $table->string('email')->nullable()->change();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
