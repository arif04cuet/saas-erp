<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTrainingSpeakerAssessmentsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('training_speaker_assessments', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('training_id');
                $table->double('score');
                $table->string('topic');
                $table->string('recommendation');
                $table->date('date');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('training_speaker_assessments');
        }
    }
