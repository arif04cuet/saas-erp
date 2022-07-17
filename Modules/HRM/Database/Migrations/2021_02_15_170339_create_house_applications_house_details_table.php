<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseApplicationsHouseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('house_application_house_details')) {
            Schema::create('house_application_house_details', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('house_application_id');
                $table->unsignedInteger('house_detail_id');
                $table->timestamps();
            });
        }

        if (Schema::hasColumn('house_applications', 'house_no')) {
            Schema::table('house_applications', function (Blueprint $table) {
                $table->dropColumn('house_no');
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
        Schema::dropIfExists('house_application_house_details');

        if (!Schema::hasColumn('house_applications', 'house_no')) {
            Schema::table('house_applications', function (Blueprint $table) {
                $table->string('house_no')->nullable();
            });
        }
    }
}
