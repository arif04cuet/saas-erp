<?php

namespace App\Http\Controllers;

use App\Entities\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Module;
use App\Models\SpatieRole;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Traits\Authorizable;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    use Authorizable;
    private $roleService;
    private $permissionService;

    /**
     * RoleController constructor.
     * @param $roleService
     * @param $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        //$this->authorizeResource(Role::class);

        //$this->middleware('permission:role-list|role-create|role-edit', ['only' => ['index', 'show']]);
        // $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['index']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $roles = $this->roleService->getRolesWithPermission();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {

        $permissions = $this->permissionService->moduleWisePermissions();
        $modules = Module::get()->keyBy('id')->toArray();
        $lang = app()->getLocale();
        $role = new SpatieRole();
        return view('role.create', compact('permissions', 'modules', 'lang', 'role'));
    }


    /**
     * @param StoreRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRoleRequest $request)
    {

        $response = $this->roleService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $role = $this->roleService->findOrFail($id);
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {

        $role = $this->roleService->findOrFail($id);
        $permissions = $this->permissionService->moduleWisePermissions();
        $modules = Module::get()->keyBy('id')->toArray();
        $lang = app()->getLocale();
        return view('role.edit', compact('role', 'permissions', 'modules', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRoleRequest $request, SpatieRole $role)
    {

        $response = $this->roleService->updateRole($role->id, $request->all());
        Session::flash('message', $response->getContent());

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {

        $response = $this->roleService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('roles.index');
    }
}
