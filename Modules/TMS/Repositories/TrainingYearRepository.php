<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingYear;
use Modules\TMS\Services\TrainingTypeService;

class TrainingYearRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingYear::class;
    
    public function all()
    {
        return $this->model->all();
    }


    public function store($request)
    {
        $this->model->create($request);
    }

    public function find($id)  
    {
        return $this->findOne($id);
    }
    
    public function update($id,$request)
    {
        $this->findOne($id)->update($request);
    }

}
