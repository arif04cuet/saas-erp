<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLangFieldsNullableToRegisteredTraineeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = $this->getColumns();
        $tableName = 'registered_trainee_service';
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
        $tableName = 'registered_trainee_service';
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
            'designation',
            'designation_bn',
        ];
    }
}
