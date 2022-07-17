<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/2/19
 * Time: 5:04 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingVenue;

class TrainingVenueRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingVenue::class;

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