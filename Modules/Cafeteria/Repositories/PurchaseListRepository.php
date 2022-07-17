<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\PurchaseList;

class PurchaseListRepository extends AbstractBaseRepository 
{

    protected $modelName = PurchaseList::class;

}
