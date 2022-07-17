<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\HouseCircularDesignation;

class HouseCircularDesignationRepository extends AbstractBaseRepository 
{

    protected $modelName = HouseCircularDesignation::class;

    public function deleteCircularDesignations($categoryId)
    {
        return $this->model->where('house_circular_category_id', $categoryId)->delete();
    }

}
