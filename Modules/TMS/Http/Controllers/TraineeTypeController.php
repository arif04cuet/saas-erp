<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Modules\TMS\Entities\Trainee;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\TraineeType;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Modules\TMS\Services\TraineeTypeService;

class TraineeTypeController extends Controller
{
     /**
     * @var TraineeTypeService
     */
    private $traineeTypeService;

    public function __construct(TraineeTypeService $traineeTypeService)
    {
        /** @var TraineeTypeService $traineeTypeService */
        $this->traineeTypeService = $traineeTypeService;
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
        $member_names = ['1' => 'A', '2' => 'B', '3' => 'C'];
        return view('tms::trainee.create.trainee_type', compact('trainee','member_names'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function store(Request $request, Trainee $trainee)
    {
        $success = $this->traineeTypeService->storeTraineeTypeInfo($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainee.trainee-type.show', $trainee);
    }

    /**
     * Show the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function show(Trainee $trainee)
    {
        return view('tms::trainee.show.trainee_type', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function edit(Trainee $trainee)
    {
        $member_names = ['1' => 'A', '2' => 'B', '3' => 'C'];
        if($trainee->traineeType->trainee_type == 'association'){
            $status = true;
            $style = 'display:block';
        }else{
            $status = false;
            $style = 'display:none';
        }
        if($trainee->traineeType->trainee_type == 'doptor'){
            $status2 = true;
            $style2 = 'display:block';
        }else{
            $status2 = false;
            $style2 = 'display:none';
        }
        return view('tms::trainee.edit.trainee_type', compact('trainee','member_names','status','style','status2','style2'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function update(Request $request, Trainee $trainee)
    {
        // dd($request->all());
        $success = $this->traineeTypeService->updateTraineeTypeInfo($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('lables.save_error'));
        }

        return redirect()->route('trainee.trainee-type.show', $trainee);
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
