<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/10/18
 * Time: 11:55 AM
 */

namespace App\Repositories;


use App\Entities\Permission;
use App\Models\SpatiePermission;

class PermissionRepository extends AbstractBaseRepository
{
    protected $modelName = SpatiePermission::class;

    public function getPermissions()
    {
        return SpatiePermission::get()->pluck('name', 'id');
    }

    public function moduleWisePermissions()
    {
        return SpatiePermission::get()->groupBy('module_id');
    }
}
