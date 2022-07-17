<?php

/**
 * Created by VS.
 * User: araf111
 * Date: 14/03/22
 * Time: 5:04 PM
 */

namespace App\Repositories;


use App\Repositories\AbstractBaseRepository;
use App\Models\Doptor;

class DoptorRepository extends AbstractBaseRepository
{
    protected $modelName = Doptor::class;

    // public function all()
    // {
    //     return $this->model->all();
    // }


    // public function store($request)
    // {
    //     $this->model->create($request);
    // }

    public function find($id)
    {
        return $this->findOne($id);
    }

    // public function update($id,$request)
    // {
    //     $this->findOne($id)->update($request);
    // }

    public function pluck()
    {
        return $this->getModel()->pluck('name_eng', 'id');
    }
}
