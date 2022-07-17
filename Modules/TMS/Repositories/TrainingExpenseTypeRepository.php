<?php

/**
 * Created by vs code.
 * User: araf
 * Date: 10/05/2022
 * Time: 5:04 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingExpenseType;

class TrainingExpenseTypeRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingExpenseType::class;

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

    public function update($id, $request)
    {
        $this->findOne($id)->update($request);
    }
}
