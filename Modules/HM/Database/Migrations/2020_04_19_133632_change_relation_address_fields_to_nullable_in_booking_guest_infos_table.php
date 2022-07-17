<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRelationAddressFieldsToNullableInBookingGuestInfosTable extends Migration
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
            $table->string('relation')->nullable()->change();
            $table->string('address')->nullable()->default(null)->change();
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

        Schema::table('booking_guest_infos', function (Blueprint $table) {
            $table->string('relation')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
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
