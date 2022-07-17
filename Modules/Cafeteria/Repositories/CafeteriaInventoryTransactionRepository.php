<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\CafeteriaInventoryTransaction;

class CafeteriaInventoryTransactionRepository extends AbstractBaseRepository 
{

    protected $modelName = CafeteriaInventoryTransaction::class;

}
