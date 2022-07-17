<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings', function (Blueprint $table) {
            DB::statement("ALTER TABLE trainings CHANGE COLUMN training_id uid varchar(100)");
            DB::statement("ALTER TABLE trainings CHANGE COLUMN training_title title varchar(100)");
            DB::statement("ALTER TABLE trainings CHANGE COLUMN status " .
                "status ENUM('draft', 'published', 'running', 'completed', 'canceled') DEFAULT 'draft'");

            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('no_of_batches')->nullable();
            $table->date('registration_deadline')->nullable();
            $table->enum('level', ['national', 'international'])->default('national');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->renameColumn('title', 'training_title');
            $table->renameColumn('uid', 'training_id');

            $table->dropColumn(['category_id', 'no_of_batches', 'registration_deadline']);
            DB::statement("ALTER TABLE trainings DROP COLUMN level");
            DB::statement("ALTER TABLE trainings MODIFY COLUMN status TINYINT");
        });
    }
}
