<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Services\TraineeEducationInfoService;

class TraineeEducationInfoController extends Controller
{
    /**
     * @var TraineeEducationInfoService
     */
    private $traineeEducationInfoService;

    public function __construct(TraineeEducationInfoService $traineeEducationInfoService)
    {
        /** @var TraineeEducationInfoService $traineeEducationInfoService */
        $this->traineeEducationInfoService = $traineeEducationInfoService;
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
        return view('tms::trainee.create.education_info', compact('trainee'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function store(Request $request, Trainee $trainee)
    {
        $success = $this->traineeEducationInfoService->storeEducationInfo($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainee.education-info.show', $trainee);
    }

    /**
     * Show the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function show(Trainee $trainee)
    {
        return view('tms::trainee.show.education_info', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function edit(Trainee $trainee)
    {
        return view('tms::trainee.edit.education_info', compact('trainee'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function update(Request $request, Trainee $trainee)
    {
        $success = $this->traineeEducationInfoService->updateEducationInfo($trainee, $request->all());
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
