<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/9/18
 * Time: 2:56 PM
 */

namespace App\Repositories;

use App\Entities\Role;
use App\Models\SpatieRole;

class RoleRepository extends AbstractBaseRepository
{
    protected $modelName = SpatieRole::class;

    public function pluck()
    {
        return $this->getModel()->pluck('label', 'id');
    }
}
