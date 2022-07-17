<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('designations', 'bangla_name')) {
            Schema::table('designations', function (Blueprint $table) {
                $table->string('bangla_name')->after('name')->nullable();
                $table->tinyInteger('hierarchy_level')->after('department_id')->default(0);
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
        if (Schema::hasColumn('designations', 'bangla_name')) {
            Schema::table('designations', function (Blueprint $table) {
                $table->dropColumn('bangla_name');
                $table->dropColumn('hierarchy_level');
            });
        }
    }
}
