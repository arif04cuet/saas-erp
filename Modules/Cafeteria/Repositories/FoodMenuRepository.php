<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\FoodMenu;

class FoodMenuRepository extends AbstractBaseRepository 
{

    protected $modelName = FoodMenu::class;

}
