<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\TMS\Services\TraineeWhoDidNotSubmitSpeakerEvaluationService;

class TraineeWhoDidNotSubmitSpeakerEvaluationController extends Controller
{
    private $service;

    public function __construct(
        TraineeWhoDidNotSubmitSpeakerEvaluationService $traineeWhoDidNotSubmitSpeakerEvaluationService
    ) {
        $this->service = $traineeWhoDidNotSubmitSpeakerEvaluationService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {

        $jsFilterOptions = $this->service->loadJsFilterOptions();
        $dropdownSelectedValues = $this->service->getDropdownSelectedValues($jsFilterOptions);
        // load all the training data
        // dd('how');
        $sessionIds = $this->getSessionIdsFromModuleArray($jsFilterOptions['sessions_by_module']);
        $data = $this->service->loadData($dropdownSelectedValues['training_course_selected_value'], $sessionIds);
        // load default data
        $indexData = $this->service->getIndexData($data, $dropdownSelectedValues);
        // dd($jsFilterOptions);
        return view(
            'tms::training.assessment.speaker-evaluation.did_not_evaluate',
            compact('jsFilterOptions', 'dropdownSelectedValues', 'indexData', 'data')
        );
    }


    public function loadData($trainingCourseId)
    {
        $jsFilterOptions = $this->service->loadJsFilterOptions($trainingCourseId);
        $dropdownSelectedValues = $this->service->getDropdownSelectedValues($jsFilterOptions);
        // load all the training data
        $sessionIds = $this->getSessionIdsFromModuleArray($jsFilterOptions['sessions_by_module']);
        $data = $this->service->loadData($trainingCourseId, $sessionIds);
        // load default data
        $indexData = $this->service->getIndexData($data, $dropdownSelectedValues)->first();
        return collect([
            'jsFilterOptions' => $jsFilterOptions,
            'dropdownSelectedValues' => $dropdownSelectedValues,
            'indexData' => $indexData,
            'data' => $data,
        ]);
    }

    //---------------------------------------------------------------------------------------------
    //                              Private Function
    //---------------------------------------------------------------------------------------------
    private function getSessionIdsFromModuleArray($data)
    {
        $objects = array_values($data);
        return collect($objects)->mapWithKeys(function ($m) {
            return $m;
        })->keys()->toArray();
    }
}
