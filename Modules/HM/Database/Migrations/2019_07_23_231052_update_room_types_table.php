<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_types', function (Blueprint $table) {
            if(Schema::hasColumn('room_types', 'general_rate')) {
                $table->renameColumn('general_rate', 'government_official_rate');
            }
            if(Schema::hasColumn('room_types', 'govt_rate')) {
                $table->renameColumn('govt_rate', 'government_personal_rate');
            }
            if(Schema::hasColumn('room_types', 'bard_emp_rate')) {
                $table->renameColumn('bard_emp_rate', 'non_government_rate');
            }
            if(Schema::hasColumn('room_types', 'special_rate')) {
                $table->renameColumn('special_rate', 'international_rate');
            }

            $table->decimal('bard_rate', 10, 2)->nullable();
            $table->decimal('other_rate', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_types', function (Blueprint $table) {
            if(Schema::hasColumn('room_types', 'government_official_rate')) {
                $table->renameColumn('government_official_rate', 'general_rate');
            }
            if(Schema::hasColumn('room_types', 'government_personal_rate')) {
                $table->renameColumn('government_personal_rate', 'govt_rate');
            }
            if(Schema::hasColumn('room_types', 'non_government_rate')) {
                $table->renameColumn('non_government_rate', 'bard_emp_rate');
            }
            if(Schema::hasColumn('room_types', 'international_rate')) {
                $table->renameColumn('international_rate', 'special_rate');
            }
            if(Schema::hasColumn('room_types', 'bard_rate')) {
                $table->dropColumn('bard_rate');
            }
            if(Schema::hasColumn('room_types', 'other_rate')) {
                $table->dropColumn('other_rate');
            }
        });
    }
}
