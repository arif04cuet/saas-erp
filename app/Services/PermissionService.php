<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/10/18
 * Time: 12:01 PM
 */

namespace App\Services;


use App\Repositories\PermissionRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    use CrudTrait;

    private $permissionRepository;

    /**
     * PermissionService constructor.
     * @param $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->setActionRepository($this->permissionRepository);
    }

    public function getPermissions()
    {
        $permissions = $this->permissionRepository->getPermissions();
        return $permissions;
    }

    public function moduleWisePermissions()
    {
        return $this->permissionRepository->moduleWisePermissions();
    }
}
