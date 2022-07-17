<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/9/18
 * Time: 2:02 PM
 */

namespace App\Services;


use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoleService
{
    use CrudTrait;

    private $roleRepository;
    private $permissionRepository;

    /**
     * RoleManagementService constructor.
     * @param $roleRepository
     * @param $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->setActionRepository($this->roleRepository);
    }

    public function getRolesWithPermission()
    {
        return $this->findAll(null, 'permissions', ['column' => 'id', 'direction' => 'desc']);
    }

    public function store(array $data)
    {
        DB::transaction(function () use ($data) {

            $roleData = [
                'name' => $data['name'],
                'label' => $data['label']
            ];
            $role = $this->save($roleData);
            if (isset($data['permissions']))
                $role->syncPermissions($data['permissions']);
        });

        return new Response("Role has been created successfully");
    }

    public function updateRole($id, array $data)
    {
        $role = $this->findOrFail($id);
        DB::transaction(function () use ($role, $data) {
            $roleData = [
                'name' => $data['name'],
                'label' => $data['label']
            ];

            $role->update($roleData);
            if (isset($data['permissions']))
                $role->syncPermissions($data['permissions']);
        });
        return new Response("Role has been updated successfully");
    }

    public function destroy($id)
    {
        $role = $this->findOrFail($id);
        DB::transaction(function () use ($role) {
            $role->permissions()->detach();
            $role->users()->detach();
            $role->delete();
        });

        return new Response("Role has been deleted successfully");
    }

    public function pluck()
    {
        return $this->roleRepository->pluck();
    }

    public function getUserEmailByRoles()
    {
        $users = [];
        $userRoles = ['ROLE_DIRECTOR_ADMIN', 'ROLE_HOSTEL_MANAGER', 'ROLE_DIRECTOR_TRAINING', 'ROLE_DIRECTOR_GENERAL'];
        foreach ($userRoles as $key => $userRole) {
            $role = $this->roleRepository->findBy(['name' => $userRole])->first();
            if (isset($role->users)) {
                $users = array_merge($users, $role->users->toArray());
            }
        }
        $emails = array_unique(array_column($users, 'email'));

        return $emails;
    }

    public function firstOrCreate($roleName)
    {
        return $this->actionRepository->getModel()::firstOrCreate([
            'name' => $roleName,
        ]);
    }
}
