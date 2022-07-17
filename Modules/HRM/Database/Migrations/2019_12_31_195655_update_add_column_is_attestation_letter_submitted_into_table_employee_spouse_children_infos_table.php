<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddColumnIsAttestationLetterSubmittedIntoTableEmployeeSpouseChildrenInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_spouse_children_infos', function (Blueprint $table) {
            $table->boolean('is_attestation_letter_submitted')
                ->after('date_of_birth')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_spouse_children_infos', function (Blueprint $table) {
            if(Schema::hasColumn('employee_spouse_children_infos', 'is_attestation_letter_submitted')) {
                $table->dropColumn('is_attestation_letter_submitted');
            }
        });
    }
}
