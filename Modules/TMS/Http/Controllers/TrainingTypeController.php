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
use Modules\TMS\Entities\TrainingType;
use Illuminate\Support\Facades\Auth;
use Modules\TMS\Http\Requests\TrainingTypeRequest;
use Modules\TMS\Services\TrainingCategoryService;
use Modules\TMS\Services\TrainingTypeService;
use Modules\TMS\Services\TrainingOrganizationService;
use Modules\TMS\Services\TrainingsService;
use Illuminate\Support\Facades\Session;

class TrainingTypeController extends Controller
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
     * @var TrainingTypeService
     */
    private $trainingTypeService;


    public function __construct(
        TrainingsService $trainingService,
        TrainingOrganizationService $trainingOrganizationService,
        TrainingTypeService $trainingTypeService,
        TrainingCategoryService $categoryService
    ) {
        $this->trainingService = $trainingService;
        $this->categoryService = $categoryService;
        $this->trainingTypeService = $trainingTypeService;
        $this->trainingOrganizationService = $trainingOrganizationService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index(TrainingType $trainingType)
    {
        if (app()->getLocale() == 'bn') {
            $parents = TrainingType::all()->pluck('name_bangla', 'id');
        } else {
            $parents = TrainingType::all()->pluck('name_english', 'id');
        }

        $trainingTypes = $this->trainingTypeService->findAll(
            null,
            null,
            ['column' => 'created_at', 'direction' => 'asc']
        );
        $participantTypes = $this->trainingService->getAllParticipantTypes();
        $trainingOrganizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();

        return view('tms::training-type.index', compact('trainingType', 'trainingTypes', 'participantTypes', 'trainingOrganizations', 'parents'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $participantTypes = $this->trainingService->getAllParticipantTypes();
        $trainingOrganizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();
        return view(
            'tms::training-type.create',
            compact('participantTypes', 'trainingOrganizations')
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param TrainingHeadRequest $trainingHeadRequest
     * @return RedirectResponse
     */
    public function store(TrainingTypeRequest $trainingTypeRequest)
    {
        if ($this->trainingTypeService->store($trainingTypeRequest->all())) {
            return redirect()->route('training-type.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('training-type.index')->with(
                'error',
                trans('labels.save_fail')
            );
        }
    }

    /**
     * Show the specified resource.
     * @param TrainingHead $trainingHead
     * @return Factory|Application|Response|View
     */
    public function show(TrainingType $trainingType)
    {
        return view('tms::training-type.show', compact('trainingType'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param TrainingHead $trainingHead
     * @return Factory|Application|Response|View
     */
    public function edit(TrainingType $trainingType)
    {
        if (app()->getLocale() == 'bn') {
            $parents = TrainingType::all()->pluck('name_bangla', 'id');
        } else {
            $parents = TrainingType::all()->pluck('name_english', 'id');
        }

        $participantTypes = $this->trainingService->getAllParticipantTypes();
        $trainingOrganizations = $this->trainingOrganizationService->getTrainingOrganizationsForDropdown();
        return view('tms::training-type.edit', compact('trainingType', 'participantTypes', 'trainingOrganizations', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     * @param TrainingHeadRequest $request
     * @param TrainingHead $trainingHead
     * @return RedirectResponse
     */
    public function update(TrainingTypeRequest $request, TrainingType $trainingType)
    {
        if ($this->trainingTypeService->updateData($request->all(), $trainingType)) {
            return redirect()->route('training-type.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('training-type.index')->with(
                'error',
                trans('labels.update_fail')
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TrainingHead $trainingType
     * @return void
     */
    public function destroy($id)
    {
        $response = $this->trainingTypeService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('training-type');
    }
}
