<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 12/3/18
 * Time: 12:00 PM
 */

namespace App\Services;


use App\Entities\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class PasswordManagementService
{
    private $userService;

    /**
     * PasswordManagementService constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function updatePassword(User $user, $newPassword)
    {
        $this->userService->update($user, [
            'password' => Hash::make($newPassword),
            'last_password_change' => new \DateTime(),
        ]);

        return new Response('Password has been changed successfully');
    }
}
