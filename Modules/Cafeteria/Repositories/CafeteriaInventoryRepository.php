<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\CafeteriaInventory;

class CafeteriaInventoryRepository extends AbstractBaseRepository 
{

    protected $modelName = CafeteriaInventory::class;

}
