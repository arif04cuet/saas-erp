<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsToPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('prescriptions','comments')) {
            Schema::table('prescriptions', function (Blueprint $table) {
                $table->string('comments',255)->nullable()->after('symptoms');
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
        if (Schema::hasColumn('prescriptions','comments')) {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropColumn('comments');
        });
    }
    }
}
