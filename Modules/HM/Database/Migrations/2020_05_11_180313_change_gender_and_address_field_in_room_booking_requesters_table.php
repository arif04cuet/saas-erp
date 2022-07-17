<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGenderAndAddressFieldInRoomBookingRequestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->registerEnumWithDoctrine();
        Schema::table('room_booking_requesters', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            // changing gender column
            // doctrine package do not support changing column type of "enum" [ from the laravel doc]
            // so changing manually
            $status = Config('hm.booking_guest_info.gender');
            $genderOptionString = implode("','", $status);
            $query = "ALTER TABLE room_booking_requesters CHANGE COLUMN gender gender enum ('" . $genderOptionString . "') NULL";
            DB::statement($query);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->registerEnumWithDoctrine();
        Schema::table('room_booking_requesters', function (Blueprint $table) {
            $table->string('address')->nullable(false)->change();
            // changing gender column
            $status = Config('hm.booking_guest_info.gender');
            $genderOptionString = implode("','", $status);
            $query = "ALTER TABLE room_booking_requesters CHANGE COLUMN gender gender enum ('" . $genderOptionString . "')  NOT NULL";
            DB::statement($query);
        });
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
