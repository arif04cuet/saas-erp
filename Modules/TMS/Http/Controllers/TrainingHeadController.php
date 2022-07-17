<?php

namespace Modules\TMS\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingHead;
use Modules\TMS\Http\Requests\TrainingHeadRequest;
use Modules\TMS\Services\TrainingCategoryService;
use Modules\TMS\Services\TrainingHeadService;
use Modules\TMS\Services\TrainingOrganizationService;
use Modules\TMS\Services\TrainingsService;
use Illuminate\Support\Facades\Session;

class TrainingHeadController extends Controller
{
    /**
     * @var TrainingsService
     */
    private $trainingService;
    /**
     * @var TrainingCategoryService
     */
    private $categoryService;
    /**
     * @var TrainingOrganizationService
     */
    private $trainingOrganizationService;
    /**
     * @var TrainingHeadService
     */
    private $trainingHeadService;

    public function __construct(
        TrainingsService $trainingService,
        TrainingOrganizationService $trainingOrganizationService,
        TrainingHeadService $trainingHeadService,
        TrainingCategoryService $categoryService
    ) {
        $this->trainingService = $trainingService;
        $this->categoryService = $categoryService;
        $this->trainingHeadService = $trainingHeadService;
        $this->trainingOrganizationService = $trainingOrganizationService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $this->trainingHeadService->clearOldSessionValues();
        $trainingHeads = $this->trainingHeadService->findAll(null, null,
            ['column' => 'created_at', 'direction' => 'asc']);
        $participantTypes = $this->trainingService->getAllParticipantTypes();
        $trainingOrganizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();

        return view('tms::training-head.index', compact('trainingHeads','participantTypes', 'trainingOrganizations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $this->trainingHeadService->clearOldSessionValues();
        $participantTypes = $this->trainingService->getAllParticipantTypes();
        $trainingOrganizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();
        return view('tms::training-head.create',
            compact('participantTypes', 'trainingOrganizations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param TrainingHeadRequest $trainingHeadRequest
     * @return RedirectResponse
     */
    public function store(TrainingHeadRequest $trainingHeadRequest)
    {
        if ($this->trainingHeadService->store($trainingHeadRequest->all())) {
            return redirect()->route('training-head.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('training-head.index')->with('error',
                trans('labels.save_fail'));
        }

    }

    /**
     * Show the specified resource.
     * @param TrainingHead $trainingHead
     * @return Factory|Application|Response|View
     */
    public function show(TrainingHead $trainingHead)
    {
        // dd($trainingHead);
        $trainings = $this->trainingHeadService->getTrainings($trainingHead);
        return view('tms::training-head.show', compact('trainingHead', 'trainings'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param TrainingHead $trainingHead
     * @return Factory|Application|Response|View
     */
    public function edit(TrainingHead $trainingHead)
    {
        $this->trainingHeadService->setTrainingHeadAsOldValues($trainingHead);
        $participantTypes = $this->trainingService->getAllParticipantTypes();
        $trainingOrganizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();
        return view('tms::training-head.edit', compact('trainingHead', 'participantTypes', 'trainingOrganizations'));
    }

    /**
     * Update the specified resource in storage.
     * @param TrainingHeadRequest $request
     * @param TrainingHead $trainingHead
     * @return RedirectResponse
     */
    public function update(TrainingHeadRequest $request, TrainingHead $trainingHead)
    {
        if ($this->trainingHeadService->updateData($request->all(), $trainingHead)) {
            return redirect()->route('training-head.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('training-head.index')->with('error',
                trans('labels.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TrainingHead $trainingHead
     * @return void
     */
    public function destroy($id)
    {
        $response = $this->trainingHeadService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect('/tms/training-name/');
    }
}
