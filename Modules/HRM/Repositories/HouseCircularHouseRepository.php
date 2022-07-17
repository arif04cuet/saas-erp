<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\HouseCircularHouse;

class HouseCircularHouseRepository extends AbstractBaseRepository 
{

    protected $modelName = HouseCircularHouse::class;

    public function deleteCircularHouses($catrgory_id)
    {
        return $this->model->where('house_circular_category_id', $catrgory_id)->delete();
    }

}
