<?php

namespace Modules\RMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Services\EmployeeService;
use Modules\RMS\Entities\ResearchRequest;
use Modules\RMS\Entities\ResearchRequestAttachment;
use Modules\RMS\Http\Requests\CreateResearchRequestRequest;
use Modules\RMS\Http\Requests\UpdateResearchRequestRequest;
use Modules\RMS\Services\ResearchRequestService;

class ResearchRequestController extends Controller
{
    private $researchRequestService;
    /**
     * @var EmployeeService
     */
    private $employeeServices;


    public function __construct(ResearchRequestService $researchRequestService, EmployeeService $employeeServices)
    {
        $this->researchRequestService = $researchRequestService;
        $this->employeeServices = $employeeServices;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $research_requests = $this->researchRequestService->getInvitationsReceivedByUser();
        return view('rms::research-request.index', compact('research_requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employees = $this->employeeServices->getEmployeesForDropdown(function ($employee) {
            $designation = !is_null($employee->designation) ? $employee->designation->name : 'No Designation';
            return $employee->first_name . ' ' . $employee->last_name . ' - ' . $designation . ' - ' . $employee->employeeDepartment->name;
        });
        return view('rms::research-request.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateResearchRequestRequest $request)
    {
        $researchRequest = $this->researchRequestService->store($request->all());
        if (!Session::has('success')) {
            Session::flash('success', trans('labels.save_success'));
        }
        return redirect()->route('research-request.index');
    }

    /**
     * Show the specified resource.
     * @param ResearchRequest $researchRequest
     * @return Response
     */
    public function show(ResearchRequest $researchRequest)
    {
        $receiverIds = $researchRequest->researchRequestReceivers
            ->pluck('to')
            ->toArray();
        return view('rms::research-request.show', compact('researchRequest', 'receiverIds'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(ResearchRequest $researchRequest)
    {
        return view('rms::research-request.edit', compact('researchRequest'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateResearchRequestRequest $request, ResearchRequest $researchRequest)
    {
        $this->researchRequestService->updateResearchRequest($request->all(), $researchRequest);
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('research-request.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function requestAttachmentDownload(ResearchRequest $researchRequest)
    {
        return response()->download($this->researchRequestService->getZipFilePath($researchRequest->id));
    }

    public function fileDownload(ResearchRequestAttachment $researchRequestAttachment)
    {
        $basePath = Storage::disk('internal')->path($researchRequestAttachment->attachments);
        return response()->download($basePath);
    }

}
