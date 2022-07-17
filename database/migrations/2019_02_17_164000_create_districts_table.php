<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateDistrictsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('districts', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('division_id');
                $table->string('name')->nullable(false)->unique();
                $table->string('bn_name')->nullable(false);
                $table->double('lat')->nullable(false);
                $table->double('lon')->nullable(false);
                $table->string('website')->nullable(false);
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
            Schema::dropIfExists('districts');
        }
    }
