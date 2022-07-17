<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\TMS\Entities\AnnualTrainingNotification;
use Modules\TMS\Services\AnnualTrainingNotificationService;
use Modules\TMS\Services\TrainingOrganizationService;

class AnnualTrainingNotificationController extends Controller
{

    /**
     * @var AnnualTrainingNotificationService
     */
    private $annualTrainingNotificationService;
    /**
     * @var TrainingOrganizationService
     */
    private $trainingOrganizationService;
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * AnnualTrainingNotificationController constructor.
     * @param AnnualTrainingNotificationService $annualTrainingNotificationService
     * @param TrainingOrganizationService $trainingOrganizationService
     */
    public function __construct(
        AnnualTrainingNotificationService $annualTrainingNotificationService,
        TrainingOrganizationService $trainingOrganizationService
    ) {
        $this->annualTrainingNotificationService = $annualTrainingNotificationService;
        $this->trainingOrganizationService = $trainingOrganizationService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $notifications = $this->annualTrainingNotificationService->findAll();
        return view('tms::annual-training-notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $years = $this->annualTrainingNotificationService->getYears();
        $organizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();
        return view('tms::annual-training-notification.create', compact('years', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(Request $request)
    {
        if ($this->annualTrainingNotificationService->store($request->all())) {
            return redirect()->route('annual-training-notification.index');
        }
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $notification = $this->annualTrainingNotificationService->findOne($id);
        $divisionalDirectors = $notification->send_to_divisional_director ?
            $this->annualTrainingNotificationService->getDivisionalDirectors() : [];
        return view('tms::annual-training-notification.show', compact('notification', 'divisionalDirectors'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('tms::edit');
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

    /**
     * @param $notificationId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadAttachment($notificationId)
    {
        $notification = $this->annualTrainingNotificationService->findOne($notificationId);
        $file = Storage::disk('internal')->path($notification->attachment);
        return response()->download($file, $notification->attachment_file_name);
    }

    public function print(AnnualTrainingNotification $annualTrainingNotification)
    {
        $divisionalDirectors = $annualTrainingNotification->send_to_divisional_director ?
            $this->annualTrainingNotificationService->getDivisionalDirectors() : [];
        return view('tms::annual-training-notification.print.print',
            compact('annualTrainingNotification', 'divisionalDirectors'));

    }

    public function response()
    {
        return "The page is under construction";
    }
}
