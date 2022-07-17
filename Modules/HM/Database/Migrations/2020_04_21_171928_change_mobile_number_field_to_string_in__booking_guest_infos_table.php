<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMobileNumberFieldToStringInBookingGuestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->registerEnumWithDoctrine();
        Schema::table('booking_guest_infos', function (Blueprint $table) {
            $table->string('mobile_number')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // doctrine issue cant change string field to number
    }


    /**
     * Any table that has a enum type column, changing other column will also run into
     * 'Unknown database type enum requested, Doctrine\DBAL\Platforms\MySQL57Platform' Exception
     * Workaround:
     * @link https://chasingcode.dev/blog/update-enum-column-doctrine-exception/
     */

    private function registerEnumWithDoctrine()
    {
        DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('enum', 'string');
    }
}
