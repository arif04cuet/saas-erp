<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateThanasTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('thanas', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('district_id');
                $table->string('name')->nullable(false);
                $table->string('bn_name')->nullable(false);
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
            Schema::dropIfExists('thanas');
        }
    }
