<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsVatTaxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tms_vat_tax_details')) {
            Schema::create('tms_vat_tax_details', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('training_id')->nullable(false);
                $table->unsignedInteger('tms_journal_entry_detail_id')->nullable(false);
                $table->double('vat_amount')->default(0.0);
                $table->double('tax_amount')->default(0.0);
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tms_vat_tax_details');
    }
}
