<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\CashBookEntry;

class CashBookEntryRepository extends AbstractBaseRepository
{

    protected $modelName = CashBookEntry::class;

}
