<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrganizationMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organization_members', function (Blueprint $table) {
            if (Schema::hasColumn('organization_members', 'age')) {
                $table->dropColumn('age');
            }
            $table->date('dob')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('short_code', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_members', function (Blueprint $table) {
            $dropColumns = $this->getColumnsToBeDeleted();

            $table->dropColumn($dropColumns);
            $table->integer('age')->nullable()->after('nid');
        });
    }

    /**
     * @return mixed
     */
    private function getColumnsToBeDeleted()
    {
        $columnsToBeDeleted = [];
        foreach (['dob', 'is_active', 'short_code'] as $column) {
            if (Schema::hasColumn('organization_members', $column)) {
                array_push($columnsToBeDeleted, $column);
            }
        }
        return $columnsToBeDeleted;
    }
}
