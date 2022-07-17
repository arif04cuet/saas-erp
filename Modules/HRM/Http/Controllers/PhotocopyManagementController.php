<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\DepartmentService;

class PhotocopyManagementController extends Controller
{

    private $departmentService;
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $requests = [
            ['title' => 'HR Policy On leave', 'type' => 'Internal Document', 'priority' => 'High','pages' => 20, 'user' => 'Test User 1'],
            ['title' => 'Notice on Office Worktime', 'type' => 'Notice', 'priority' => 'Medium','pages' => 25, 'user' => 'Test User 2'],
            ['title' => 'Test Document', 'type' => 'Office Document', 'priority' => 'Low','pages' => 16, 'user' => 'Test User 3'],
        ];

        return view('hrm::photocopy-management.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $departments = $this->departmentService->findAll();

        return view('hrm::photocopy-management.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Session::flash('message', 'Demo! Data Not Saved');

        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $requests = [
            ['title' => 'HR Policy On leave', 'type' => 'Internal Document', 'priority' => 'High','pages' => 20, 'user' => 'Test User 1'],
            ['title' => 'Notice on Office Worktime', 'type' => 'Notice', 'priority' => 'Medium','pages' => 25, 'user' => 'Test User 2'],
            ['title' => 'Test Document', 'type' => 'Office Document', 'priority' => 'Low','pages' => 16, 'user' => 'Test User 3'],
        ];
        $request = $requests[$id];

        return view('hrm::photocopy-management.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hrm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
