<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobCircularDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_circular_details')) {
            Schema::create('job_circular_details', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('job_circular_id');
                $table->unsignedInteger('designation_id');
                $table->string('salary_grade');
                $table->integer('vacancy_no');
                $table->integer('max_age');
                $table->string('max_age_divisional_employee');
                $table->string('max_age_quota_employee');
                $table->text('educational_requirement');
                $table->text('experience_requirement');
                $table->text('job_responsibility');
                $table->timestamps();
            });
            $this->removeColumnsFromJobCircular();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_circular_details');
    }

    private function removeColumnsFromJobCircular()
    {
        $columns = [
            'designation_id',
            'salary_grade',
            'vacancy_no',
            'max_age',
            'max_age_divisional_employee',
            'max_age_quota_employee',
            'educational_requirement',
            'experience_requirement',
            'job_responsibility'
        ];
        foreach ($columns as $column) {
            if (Schema::hasColumn('job_circulars', $column)) {
                Schema::table('job_circulars', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
}
