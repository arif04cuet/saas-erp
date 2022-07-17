<?php

namespace Modules\TMS\Http\Controllers;

use App\Entities\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Modules\TMS\Entities\AnnualTrainingNotification;
use Modules\TMS\Entities\AnnualTrainingNotificationResponse;
use Modules\TMS\Http\Requests\AnnualTrainingNotificationResponseRequest;
use Modules\TMS\Services\AnnualTrainingNotificationResponseService;

class AnnualTrainingNotificationUserResponseController extends Controller
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
     * @param AnnualTrainingNotification $annualTrainingNotification
     * @param User $user
     * @return Response
     */
    public function create(AnnualTrainingNotification $annualTrainingNotification, User $user)
    {
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes();
        $trainingNotificationId = $annualTrainingNotification->id ?? null;
        $type = $responseTypes[1];
        $this->annualTrainingNotificationResponseService->clearSessionValues();
        return view('tms::annual-training-notification.response.create',
            compact('user', 'type', 'responseTypes', 'trainingNotificationId'));
    }

    /**
     * @param AnnualTrainingNotificationResponseRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(AnnualTrainingNotificationResponseRequest $request)
    {
        if ($this->annualTrainingNotificationResponseService->store($request->all())) {
            return redirect(route('tms.annual-training-notification.response.user.create',
                [$request['annual_training_notification_id'], $request['user_id']]))
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect(route('tms.annual-training-notification.response.user.create',
                [$request['annual_training_notification_id'], $request['user_id']]))
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
     * Show the form for editing the specified resource.
     * @param AnnualTrainingNotification $annualTrainingNotification
     * @param User $user
     * @return Factory|Application|View
     */
    public function edit(AnnualTrainingNotification $annualTrainingNotification, User $user)
    {
        $oldResponses = $this->annualTrainingNotificationResponseService->getOldResponsesForUser($user->id,
            $annualTrainingNotification->id);
        if (!is_null($oldResponses)) {
            session(['_old_input.response' => $oldResponses]);
        }
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes();
        $trainingNotificationId = $annualTrainingNotification->id ?? null;
        $type = $responseTypes[1];
        return view('tms::annual-training-notification.response.create',
            compact('user', 'type', 'responseTypes', 'trainingNotificationId'));
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
