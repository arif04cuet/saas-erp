<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingType;
use Modules\TMS\Services\TrainingTypeService;

class TrainingTypeRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingType::class;

    public function pluck()
    {
        if(app()->getLocale() == 'bn'){
            return $this->getModel()->pluck('name_bangla','id');
        }else{
            return $this->getModel()->pluck('name_english','id');
        }
        
    }

}
