<?php

/**
 * Created by VS Code.
 * User: Araf
 * Date: 06/04/2022
 * Time: 1:09 PM
 */

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Entities\User;
use App\Models\Doptor;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\DoptorService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StorePublicUserRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    // use Authorizable;
    private $userService;
    private $roleService;
    private $doptorService;
    const MODEL = 'User';

    /**
     * UserController constructor.
     * @param $userService
     * @param $roleService
     */
    public function __construct(UserService $userService, RoleService $roleService, DoptorService $doptorService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->doptorService = $doptorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->findAll();
        return view('user.index', compact('users'));
    }

    public function index_datatable(UsersDataTable $datatable)
    {
        //$users = $this->userService->findAll();
        //return view('user.index-datatable');
        return $datatable->render('user.index-datatable');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->pluck();
        $userTypes = config('user.types');
        $status = config('user.status');
        return view('user.create', compact('roles', 'userTypes', 'status'));
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', self::MODEL);
        $response = $this->userService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new public resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicUserCreate(StorePublicUserRequest $request)
    {
        $response = $this->userService->publicUserCreate($request->all());
        return redirect()->route('login')->with('success', 'User has been created successfully');

        if ($response) {
            return redirect()->route('login')->with('success', 'User has been created successfully');
        } else {
            return redirect()->back()->with('fail', 'something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->userService->findOrFail($id);
        $roles = $this->roleService->pluck();
        $userTypes = config('user.types');
        $status = config('user.status');
        return view('user.edit', compact('user', 'roles', 'userTypes', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $response = $this->userService->updateUser($id, $request->all());
        Session::flash('message', $response->getContent());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->userService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('users.index');
    }
}
