<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftProposalBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_proposal_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('budgetable_id');
            $table->string('budgetable_type');
            $table->unsignedInteger('economy_code_id')->nullable();
            $table->enum('section_type', ['revenue', 'capital', 'physical_contingency', 'price_contingency'])->default('revenue');
            $table->string('unit', 20)->nullable();
            $table->double('unit_rate', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->double('total_expense', 10, 2)->nullable();
            $table->double('total_expense_percentage', 10, 2)->nullable();
            $table->double('gov_source', 10, 2)->nullable();
            $table->double('own_financing_source', 10, 2)->nullable();
            $table->double('other_source', 10, 2)->nullable();
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
        Schema::dropIfExists('draft_proposal_budgets');
    }
}
