<?php

namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\CafeteriaUnsoldFood;

class CafeteriaUnsoldFoodRepository extends AbstractBaseRepository
{
    protected $modelName = CafeteriaUnsoldFood::class;
}
