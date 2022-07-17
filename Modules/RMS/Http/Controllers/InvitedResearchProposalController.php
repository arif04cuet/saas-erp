<?php

namespace Modules\RMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\RMS\Entities\ResearchRequest;
use Modules\RMS\Entities\ResearchRequestAttachment;
use Modules\RMS\Http\Requests\CreateDateExtendRequest;
use Modules\RMS\Services\DateExtendRequestService;
use Modules\RMS\Services\ResearchRequestService;

/**
 * @property  researchRequestService
 */
class InvitedResearchProposalController extends Controller
{
    private $researchRequestService;
    private $dateExtendRequestService;

    public function __construct(ResearchRequestService $researchRequestService, DateExtendRequestService $dateExtendRequestService)
    {
        $this->researchRequestService = $researchRequestService;
        $this->dateExtendRequestService = $dateExtendRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $research_requests = $this->researchRequestService->getAll();
        return view('rms::proposal.invited.index', compact('research_requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('rms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(ResearchRequest $researchRequest)
    {
        return view('rms::proposal.invited.show', compact('researchRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('rms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function fileDownload(ResearchRequestAttachment $researchRequestAttachment)
    {
        $basePath = Storage::disk('internal')->path($researchRequestAttachment->attachments);
        return response()->download($basePath);
    }

    public function requestDateExtend(ResearchRequest $researchRequest)
    {
        return view('rms::proposal.invited.date_extend_form', compact('researchRequest'));
    }

    /*Research Proposal date extend request store method*/
    public function storeDateExtendRequest(CreateDateExtendRequest $request)
    {
        $this->dateExtendRequestService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('invited-research-proposal.index');
    }

}
