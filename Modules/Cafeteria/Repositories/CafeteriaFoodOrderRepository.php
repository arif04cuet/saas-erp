<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\CafeteriaFoodOrder;

class CafeteriaFoodOrderRepository extends AbstractBaseRepository
{

    protected $modelName = CafeteriaFoodOrder::class;

    public function foodOrderData()
    {
        return $this->model->where('status', '!=', 'draft')->orderBy('id', 'DESC')->get();
    }
}
