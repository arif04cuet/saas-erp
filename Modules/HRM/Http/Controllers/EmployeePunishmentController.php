<?php

namespace Modules\HRM\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EmployeePunishmentController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $punishmentList = [
            ['name' => 'Abdus Sattar', 'punishment_type' => 'Suspended', 'from' => '2019-01-12', 'to' => '2019-02-20' ],
            ['name' => 'Imran Khan', 'punishment_type' => 'Penalty', 'from' => '2019-01-12', 'to' => '2019-02-20' ],
        ];

        return view('hrm::punishment.index', compact('punishmentList'));
    }

    public function create()
    {
        $user = $this->userService->getLoggedInUser();

        return view('hrm::punishment.create', compact('user'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('hrm::punishment.show');
    }

    public function edit($id)
    {
        return view('hrm::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
