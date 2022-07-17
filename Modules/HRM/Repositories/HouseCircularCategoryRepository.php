<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\HouseCircularCategory;

class HouseCircularCategoryRepository extends AbstractBaseRepository 
{

    protected $modelName = HouseCircularCategory::class;

    public function hasItemInList($id)
    {
        return $this->model->where('id', $id)->count() ? true : false;
    }

    public function deleteIfItemNotInList($houseCircularId, $itemIds)
    {
        return $this->model->where('house_circular_id', $houseCircularId)->whereNotIn('id', $itemIds)->delete();
    }

}
