<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TraineeGeneralInfoService;
use Modules\TMS\Services\TraineeService;

class TraineeGeneralInfoController extends Controller
{

    /**
     * @var TraineeService
     */
    private $traineeService;
    /**
     * @var TraineeGeneralInfoService
     */
    private $traineeGeneralInfoService;

    public function __construct(
        TraineeService $traineeService,
        TraineeGeneralInfoService $traineeGeneralInfoService
    )
    {
        /** @var TraineeService $traineeService */
        $this->traineeService = $traineeService;
        /** @var TraineeGeneralInfoService $traineeGeneralInfoService */
        $this->traineeGeneralInfoService = $traineeGeneralInfoService;
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
     * @param Trainee $trainee
     * @return Response
     */
    public function create(Trainee $trainee)
    {
        $langPreference = $trainee->training->lang_preference ?? Training::getLangPreferences()['both'];
        $langOptions = Training::getLangPreferences();

        return view('tms::trainee.create.general_info', compact('trainee', 'langPreference', 'langOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Training $training
     * @return void
     */
    public function store(Request $request, Trainee $trainee)
    {
        $success = $this->traineeGeneralInfoService->storeGeneralInfo($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainee.general-info.show', $trainee);
    }

    /**
     * Show the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function show(Trainee $trainee)
    {
        return view('tms::trainee.show.general_info', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function edit(Trainee $trainee)
    {
        $langPreference = optional($trainee)->training->lang_preference ?? Training::getLangPreferences()['both'];
        $langOptions = Training::getLangPreferences();
        return view('tms::trainee.edit.general_info', compact('trainee','langOptions','langPreference'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function update(Request $request, Trainee $trainee)
    {
        $success = $this->traineeGeneralInfoService->updateGeneralInfo($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('lables.save_error'));
        }

        return redirect()->route('trainee.show', $trainee);
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
