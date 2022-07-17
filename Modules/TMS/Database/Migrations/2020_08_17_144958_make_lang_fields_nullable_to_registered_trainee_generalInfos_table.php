<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLangFieldsNullableToRegisteredTraineeGeneralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = $this->getColumns();
        $tableName = 'registered_trainee_generalInfos';
        foreach ($columns as $column) {
            if (Schema::hasColumn($tableName, $column)) {
                Schema::table($tableName, function (Blueprint $table) use ($column) {
                    $table->string($column)->nullable()->change();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $columns = $this->getColumns();
        $tableName = 'registered_trainee_generalInfos';
        foreach ($columns as $column) {
            if (Schema::hasColumn($tableName, $column)) {
                Schema::table($tableName, function (Blueprint $table) use ($column) {
                    $table->string($column)->nullable(false)->change();
                });
            }
        }
    }

    private function getColumns()
    {
        return [
            'fathers_name',
            'fathers_name_bn',
            'mothers_name',
            'mothers_name_bn',
            'present_address',
            'present_address_bn'
        ];
    }
}
