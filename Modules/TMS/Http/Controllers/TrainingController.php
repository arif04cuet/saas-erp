<?php

namespace Modules\TMS\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utilities\FiscalYearCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingHead;
use Modules\TMS\Http\Requests\TrainingRequest;
use Modules\TMS\Http\Requests\UpdateTrainingRequest;
use Modules\TMS\Services\TrainingOrganizationService;
use Modules\TMS\Services\TrainingCategoryService;
use Modules\TMS\Services\TrainingsService;
use App\Traits\Authorizable;

class TrainingController extends Controller
{
    // use Authorizable;
    /**
     * @var TrainingsService
     */
    private $trainingService;
    private $categoryService;
    /**
     * @var TrainingOrganizationService
     */
    private $trainingOrganizationService;

    public function __construct(
        TrainingsService $trainingService,
        TrainingOrganizationService $trainingOrganizationService,
        TrainingCategoryService $categoryService
    ) {
        $this->trainingService = $trainingService;
        $this->categoryService = $categoryService;
        $this->trainingOrganizationService = $trainingOrganizationService;
    }

    public function index()
    {
        $this->authorize('view_trainings');
        $orderBy = array('column' => 'id', 'direction' => 'desc');
        $trainings = $this->trainingService->trainings(false);
        $categoryNames = $this->categoryService->leaves()
            ->flatten()
            ->map(function ($category) {
                if (app()->isLocale('bn')) {
                    return $category->name_bangla;
                }
                return $category->name_english;
            });

        list($startDate, $endDate) = FiscalYearCalculator::getStartAndEndDates(Carbon::today());
        return view('tms::training.index', compact('trainings', 'categoryNames', 'startDate', 'endDate'));
    }

    public function create(Training $training)
    {
        $this->authorize('add_trainings');
        $venues = $this->trainingService->getTrainingVenuesForDropdown();
        $trainingTypes = $this->trainingService->getTrainingTypesForDropdown();
        $budgets = $this->trainingService->getBudgetsForDropdown();
        $langOptions = Training::getLangPreferences();
        $trainingThrougs = Training::getThroughTraining();
        $accommodations = Training::getAccommodation();
        $enrollTypes = Training::getEnrollAllowType();

        return view(
            'tms::training.create',
            compact('langOptions', 'trainingThrougs', 'accommodations', 'venues', 'training', 'trainingTypes', 'budgets', 'enrollTypes')
        );
    }

    public function store(TrainingRequest $request, Training $training)
    {
        $this->authorize('add_trainings');
        $training = $this->trainingService->store($request->all(), $training);
        if ($training) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('training.show', ['training_id' => $training]);
    }

    public function show($trainingId)
    {
        $this->authorize('view_trainings');
        $training = $this->trainingService->findOrFail($trainingId);
        $participantTypes = $this->trainingService->getTrainingParticipantsByTraining($training);
        $sponsors = $this->trainingService->getTrainingSponsorsByTraining($training);
        $training->totel_registered_trainee = $this->trainingService->getTotelRegistaredTrainee($training);
        return view('tms::training.show', compact('training', 'participantTypes', 'sponsors'));
    }

    public function edit(Training $training)
    {
        $this->authorize('update_trainings');
        $venues = $this->trainingService->getTrainingVenuesForDropdown();
        $trainingTypes = $this->trainingService->getTrainingTypesForDropdown();
        $budgets = $this->trainingService->getBudgetsForDropdown();
        $langOptions = Training::getLangPreferences();
        $trainingThrougs = Training::getThroughTraining();
        $accommodations = Training::getAccommodation();
        $enrollTypes = Training::getEnrollAllowType();

        return view(
            'tms::training.new_edit',
            compact('langOptions', 'trainingThrougs', 'accommodations', 'venues', 'training', 'trainingTypes', 'budgets', 'enrollTypes')
        );
    }

    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $this->authorize('update_trainings');
        $training = $this->trainingService->updateTraining($training, $request->all());
        if ($training) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('training.show', $training);
    }

    public function destroy($id)
    {
        $this->authorize('delete_trainings');
        $response = $this->trainingService->delete($id);

        if ($response) {
            $msg = __('labels.delete_success');
        } else {
            $msg = __('labels.delete_fail');
        }

        Session::flash('message', $msg);

        return redirect('/tms/training');
    }

    public function trainingForOffline()
    {
        $offlineTraining = $this->trainingService->getOfflineTrainings();
    }
}
