<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\CafeteriaIncomeExpenseEntry;

class CafeteriaIncomeExpenseEntryRepository extends AbstractBaseRepository
{

    protected $modelName = CafeteriaIncomeExpenseEntry::class;
}
