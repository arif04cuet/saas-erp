<?php

/**
 * Created by VS Code.
 * User: Araf
 * Date: 12/05/2022
 * Time: 11:42 AM
 */

namespace App\Http\Controllers;


use App\Http\Requests\UpdatePasswordRequest;
use App\Services\PasswordManagementService;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    private $passWordManagementService;
    private $userService;

    /**
     * ChangePasswordController constructor.
     * @param PasswordManagementService $passWordManagementService
     */
    public function __construct(PasswordManagementService $passWordManagementService, UserService $userService)
    {
        $this->passWordManagementService = $passWordManagementService;
        $this->userService = $userService;
    }

    public function change()
    {
        return view('auth.passwords.change');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $user = $this->userService->getLoggedInUser();
        // Checking current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }
        $response = $this->passWordManagementService->updatePassword($this->userService->getLoggedInUser(), $request['new_password']);
        Session::flash('message', $response->getContent());
        return redirect(route('dashboard'));
    }
}
