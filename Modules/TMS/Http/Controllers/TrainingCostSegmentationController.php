<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Modules\TMS\Entities\TrainingCostSegmentation;
use Modules\TMS\Services\TrainingCostSegmentationService;
use Modules\TMS\Services\TrainingExpenseTypeService;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Http\Requests\TrainingCostSegmentationRequest;

class TrainingCostSegmentationController extends Controller
{
    const Training_cost_Segmentation_VIEW = 'tms::training.cost-segmentation.';
    /**
     * @var
     */
    private $trainingCostSegmentationService;
    private $trainingService;
    private $trainingExpenseTypeService;

    public function __construct(
        TrainingCostSegmentationService $trainingCostSegmentationService,
        TrainingsService $trainingService,
        TrainingExpenseTypeService $trainingExpenseTypeService
    ) {
        $this->trainingCostSegmentationService = $trainingCostSegmentationService;
        $this->trainingService = $trainingService;
        $this->trainingExpenseTypeService = $trainingExpenseTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::create');
    }

    /**
     * @param Request $request
     */
    public function store(TrainingCostSegmentationRequest $request)
    {
        // if ($this->TrainingCostSegmentationService->store($request->all())) {
        //     return redirect()->route('training.category.index')->with('success', trans('labels.save_success'));
        // } else {
        //     return redirect()->route('training.category.index')->with('error',
        //         trans('labels.save_fail'));
        // }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Training $training)
    {
        $costSegmentationEditRoute = route('trainings.cost-segmentation.edit', [$training->id]);
        return view(self::Training_cost_Segmentation_VIEW . 'show', compact('training', 'costSegmentationEditRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Training $training)
    {
        $costSegmentations = $this->trainingService->costSegmentation($training);
        $costTypes = $this->trainingExpenseTypeService->getTrainingVenuesForDropdown();
        // dd($costTypes);
        return view(
            self::Training_cost_Segmentation_VIEW . 'edit',
            compact(
                'costSegmentations',
                'training',
                'costTypes',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TrainingCostSegmentationRequest $request, Training $training)
    {
        // dd($request->input('total_cost'));
        if ($this->trainingCostSegmentationService->update($training, $request->input('cost_segmentation'))) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }
        return redirect()->route('trainings.cost-segmentation.show', [$training->id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
