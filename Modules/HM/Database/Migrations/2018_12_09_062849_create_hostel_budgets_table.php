<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelBudgetsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'hostel_budgets', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'title' )->nullable();
			$table->string( 'section' )->nullable();
			$table->string( 'hostel_budget_title_id' );
			$table->string( 'hostel_budget_section_id' );
			$table->string( 'budget_amount' );
			$table->string( 'budget_approved_amount' )->nullable();

			$table->timestamps();
			$table->softDeletes();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'hostel_budgets' );
	}
}
