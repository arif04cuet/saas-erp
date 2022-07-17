<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Services\TraineeHealthReportService;
use Modules\TMS\Http\Requests\HealthReportRequest;
use Auth;
class TraineeHealthExamReportController extends Controller
{

    /**
     * @var TraineeHealthReportService
     */
    private $traineeHealthReportService;

    public function __construct(TraineeHealthReportService $traineeHealthReportService)
    {
        /** @var TraineeHealthReportService $traineeHealthReportService */
        $this->traineeHealthReportService = $traineeHealthReportService;
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
     * @return Response
     */
    public function create()
    {
        return view('tms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function show(Trainee $trainee)
    {
        return view('tms::trainee.show.health_report', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function edit(Trainee $trainee)
    {
        $present_diseases = [];
        $physical_disability = [];
        if ($trainee->healthExaminations){
            if(!is_null($trainee->healthExaminations->present_deseases)) {
                $present_diseases = collect(explode(',', $trainee->healthExaminations['present_deseases']))
                    ->mapWithKeys(function ($disease) {
                        return [$disease => $disease];
                    })->toArray();
            }
        }

        if ($trainee->healthExaminations){
            if (!is_null($trainee->healthExaminations->physical_disability)){
                $physical_disability = collect(explode(',', $trainee->healthExaminations['physical_disability']))
                    ->mapWithKeys(function ($disability){
                        return [$disability => $disability];
                    })->toArray();
            }
        }

        return view('tms::trainee.edit.health_report', compact('trainee', 'physical_disability', 'present_diseases'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function update(HealthReportRequest $request, Trainee $trainee)
    {
        if ($request['present_deseases']){
            $request['present_deseases'] = implode(', ', $request['present_deseases']);
        }else{
            $request['present_deseases'] = null;
        }

        if ($request['physical_disability']){
            $request['physical_disability'] = implode(', ', $request['physical_disability']);
        }else{
            $request['physical_disability'] = null;
        }
        $success = $this->traineeHealthReportService->updateHealthReport($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('labels.save_error'));
        }
        if(Auth::user()->can('tms-access-medical')){
            return redirect()->route('medical.trainee.health-reports.show', $trainee);
        }else{
            return redirect()->route('trainee.health-reports.show', $trainee);
        }
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
