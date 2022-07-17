<?php
/**
 * Created by PhpStorm.
 * User: mehadi
 * Date: 29/04/20
 * Time: 5:04 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingParticipantType;

class TrainingParticipantTypeRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingParticipantType::class;

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