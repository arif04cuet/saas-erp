<?php


namespace Modules\Publication\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Publication\Entities\PublicationIncomeExpenseEntry;

class PublicationIncomeExpenseEntryRepository extends AbstractBaseRepository
{
    protected $modelName = PublicationIncomeExpenseEntry::class;
}
