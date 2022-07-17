<?php

namespace Modules\HRM\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\JobAdmitCardService;
use Modules\HRM\Services\JobCircularService;

class JobAdmitCardController extends Controller
{
    /**
     * @var JobCircularService
     */
    private $jobCircularService;
    /**
     * @var JobAdmitCardService
     */
    private $jobAdmitCardService;

    /**
     * JobAdmitCardController constructor.
     * @param JobCircularService $jobCircularService
     * @param JobAdmitCardService $jobAdmitCardService
     */
    public function __construct(JobCircularService $jobCircularService, JobAdmitCardService $jobAdmitCardService)
    {
        $this->jobCircularService = $jobCircularService;
        $this->jobAdmitCardService = $jobAdmitCardService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param $jobCircularId
     * @return \Illuminate\View\View
     */
    public function create($jobCircularId)
    {
        $jobCircular = $this->jobCircularService->findOne($jobCircularId);
        return view('hrm::job-circular.admit-card.create', compact('jobCircular'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->jobAdmitCardService->store($request->all())) {
            return redirect()->route('job-circular.index')
                ->with('success', __('hrm::job-circular.admit_card.messages.saved'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('hrm::show');
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

    public function admitCard($admitCardId)
    {
        $admitCard = $this->jobAdmitCardService->findOne($admitCardId);
        if ($admitCard->date_of_exam > Carbon::parse()->format('Y-m-d H:i:s')) {
            $valid = true;
        } else {
            $valid = false;
        }
        $jobCircular = $admitCard->circular;
        return view('job-application.admit', compact('jobCircular', 'admitCardId', 'valid'));
    }

    public function postAdmitCard(Request $request, $admitCardId)
    {
        list($downloadUrl, $application, $jobCircular) = $this->jobAdmitCardService->generateAdmitDownloadLink(
            $request->applicant_id,
            $request->mobile,
            $admitCardId
        );

        if (!is_null($downloadUrl)) {
            return view('job-application.admit', compact('jobCircular', 'application', 'downloadUrl', 'admitCardId'));
        } else {
            return redirect()->back()->with('error', __('hrm::job-circular.admit_card.messages.wrong_info'));
        }
    }

    public function downloadAdmitFile($admitCardId, $applicantId, $hash)
    {
        if (md5($applicantId) == $hash) {
           $fileName = $this->jobAdmitCardService->generateAdmitFile([$admitCardId, $applicantId]);
           return \response()->download($fileName)->deleteFileAfterSend(true);

        }

    }
}
