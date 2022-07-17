<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\LeaveTypeService;

class LeaveTypeController extends Controller
{
    /**
     * @var LeaveTypeService
     */
    private $leaveTypeService;

    /**
     * LeaveTypeController constructor.
     * @param LeaveTypeService $leaveTypeService
     */
    public function __construct(LeaveTypeService $leaveTypeService)
    {
        $this->leaveTypeService = $leaveTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $types = $this->leaveTypeService->findAll();
        // $types = $this->leaveTypeService->removeEarnedLeave($types);

        return view('hrm::leave.types.index', compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->leaveTypeService->findOne($id);
        return view('hrm::leave.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($this->leaveTypeService->updateLeaveType($request->all(), $id)) {
            return redirect()->route('leave-types.index')->with('success', __('labels.update_success'));
        } else {
            return redirect()->back()->with('error', __('labels.update_fail'));
        }
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
