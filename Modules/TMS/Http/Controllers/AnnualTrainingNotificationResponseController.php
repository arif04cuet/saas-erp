<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Modules\TMS\Entities\AnnualTrainingNotificationResponse;
use Modules\TMS\Http\Requests\AnnualTrainingNotificationResponseRequest;
use Modules\TMS\Services\AnnualTrainingNotificationResponseService;

class AnnualTrainingNotificationResponseController extends Controller
{
    /**
     * @var AnnualTrainingNotificationResponseService
     */
    private $annualTrainingNotificationResponseService;

    public function __construct(AnnualTrainingNotificationResponseService $annualTrainingNotificationResponseService)
    {
        $this->annualTrainingNotificationResponseService = $annualTrainingNotificationResponseService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('tms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param $uniqueKey
     * @return Factory|Application|View
     */
    public function create($uniqueKey)
    {
        $organization = $this->annualTrainingNotificationResponseService->getOrganizationByUniqueKey($uniqueKey);
        $trainingNotificationId = $organization->annualTrainingNotificationId ?? null;
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes();
        $type = $responseTypes[0];
        $isOrganizationNotificationExpired = $this->annualTrainingNotificationResponseService
            ->isOrganizationNotificationExpired($organization);
        $this->annualTrainingNotificationResponseService->clearSessionValues();
        return view('tms::annual-training-notification.response.create',
            compact('organization', 'type', 'trainingNotificationId', 'responseTypes', 'uniqueKey',
                'isOrganizationNotificationExpired'));
    }

    /**
     * @param AnnualTrainingNotificationResponseRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(AnnualTrainingNotificationResponseRequest $request)
    {
        if ($this->annualTrainingNotificationResponseService->store($request->all())) {
            return redirect(route('annual-training-notification.response.organization.create', $request['unique_key']))
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect(route('annual-training-notification.response.organization.create', $request['unique_key']))
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('tms::show');
    }

    /**
     * @param $uniqueKey
     * @return Factory|Application|View
     */
    public function edit($uniqueKey)
    {
        $organization = $this->annualTrainingNotificationResponseService->getOrganizationByUniqueKey($uniqueKey);
        $oldResponses = $this->annualTrainingNotificationResponseService->getOldResponsesForOrganization($organization);
        if (!is_null($oldResponses)) {
            session(['_old_input.response' => $oldResponses]);
        }
        $trainingNotificationId = $organization->annual_training_notification_id ?? null;
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes();
        $type = $responseTypes[0];
        $isOrganizationNotificationExpired = $this->annualTrainingNotificationResponseService
            ->isOrganizationNotificationExpired($organization);
        return view('tms::annual-training-notification.response.create',
            compact('organization', 'type', 'trainingNotificationId', 'responseTypes', 'uniqueKey',
                'isOrganizationNotificationExpired'));
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
