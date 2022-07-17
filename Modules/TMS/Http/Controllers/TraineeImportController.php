<?php

namespace Modules\TMS\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TraineeImportService;
use test\Mockery\Stubs\Animal;

class TraineeImportController extends Controller
{
    private $service;

    public function __construct(TraineeImportService $traineeImportService)
    {
        $this->service = $traineeImportService;
    }


    public function downloadSample()
    {
        return $this->service->createSampleFile();
    }


    public function index(Training $training)
    {
        $numberOfTraineeCanBeInFile = $this->service->getMaxTraineeUploadMessage($training);
        $errorList = [];
        $brokenTraineeMobileList = [];
        $traineeList = [];
        return view('tms::trainee.import.import-version-2',
            compact(
                'training',
                'errorList',
                'traineeList',
                'brokenTraineeMobileList',
                'numberOfTraineeCanBeInFile'
            )
        );
    }

    public function store(Request $request, Training $training)
    {
        if ($this->service->storeData($request->all(), $training)) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('trainee.import.index', $training);
        } else {
            Session::flash('error', trans('labels.generic_error_message'));
            return redirect()->route('trainee.import.index', $training);
        }

    }

    /**
     * @param Request $request [ request will only have a file ]
     * @param Training $training
     * @return Factory|Application|RedirectResponse|View
     */
    public function show(Request $request, Training $training)
    {
        try {
            $errorList = $this->service->checkForErrors($request, $training);
            $traineeList = $this->service->getTraineeList();
            list($errorList, $brokenTraineeMobileList) = $this->service->validateTraineeList($training, $traineeList);
            $numberOfTraineeCanBeInFile = $this->service->getMaxTraineeUploadMessage($training);
            $compact = compact(
                'training',
                'traineeList',
                'errorList',
                'brokenTraineeMobileList',
                'numberOfTraineeCanBeInFile'
            );
            return view('tms::trainee.import.import-version-2', $compact);
        } catch (Exception $exception) {
            Session::flash('error', trans('labels.not_found'));
            return redirect()->route('tms::trainee.import.index', $training);
        }

    }


}
