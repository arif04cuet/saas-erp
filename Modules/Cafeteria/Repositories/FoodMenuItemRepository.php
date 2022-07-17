<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\FoodMenuItem;

class FoodMenuItemRepository extends AbstractBaseRepository 
{

    protected $modelName = FoodMenuItem::class;

    public function deleteFoodMenuItems($id)
    {
        return $this->model->where('food_menu_id', $id)->delete();
    }

    public function getFoodItems($foodMenuId)
    {
        return $this->model->where('food_menu_id', $foodMenuId)->get();
    }

}
