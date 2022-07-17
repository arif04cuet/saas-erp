<?php

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMonetaryPercentageSizeInDraftProposalBudgetFiscalValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws DBALException
     */
    public function up()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }
        Schema::table('draft_proposal_budget_fiscal_values', function (Blueprint $table) {
            $table->double('monetary_percentage', 5, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws DBALException
     */
    public function down()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }

        Schema::table('draft_proposal_budget_fiscal_values', function (Blueprint $table) {
            $table->double('monetary_percentage', 3, 2)->nullable()->change();
        });
    }
}
