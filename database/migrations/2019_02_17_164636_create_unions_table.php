<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUnionsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('unions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('thana_id');
                $table->string('name')->nullable(false);
                $table->string('bn_name')->nullable(false);
                $table->double('lat')->nullable(false);
                $table->double('lon')->nullable(false);
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
            Schema::dropIfExists('unions');
        }
    }
