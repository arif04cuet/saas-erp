<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditGpfRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('gpf_records', 'settlement_date'))
        {
            Schema::table('gpf_records', function (Blueprint $table) {
                $table->date('settlement_date')->nullable()->after('start_date');
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
        if(Schema::hasColumn('gpf_records', 'settlement_date'))
        {
            Schema::table('gpf_records', function (Blueprint $table) {
                $table->dropColumn('settlement_date');
            });
        }
    }
}
