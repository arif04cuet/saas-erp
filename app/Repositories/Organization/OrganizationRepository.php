<?php
/**
 * Created by PhpStorm.
 * User: bs100
 * Date: 1/15/19
 * Time: 6:30 PM
 */

namespace App\Repositories\Organization;


//use App\Entities\Organization\Organizable;
use App\Entities\Organization\Organization;
use App\Repositories\AbstractBaseRepository;

class OrganizationRepository extends AbstractBaseRepository
{
    protected $modelName = Organization::class;

    public function getOrganizationExceptIds($ids)
    {
        return $this->model->whereNotIn('id', $ids)->get();
    }


}