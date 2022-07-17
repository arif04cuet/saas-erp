<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Services\TraineeEmergencyContactService;

class TraineeEmergencyContactController extends Controller
{
    /**
     * @var TraineeEmergencyContactService
     */
    private $traineeEmergencyContactService;

    public function __construct(TraineeEmergencyContactService $traineeEmergencyContactService)
    {
        /** @var TraineeEmergencyContactService $traineeEmergencyContactService */
        $this->traineeEmergencyContactService = $traineeEmergencyContactService;
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
        return view('tms::trainee.create.emergency_contact', compact('trainee'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function store(Request $request, Trainee $trainee)
    {
        $success = $this->traineeEmergencyContactService->storeEmergencyContact($trainee, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainee.emergency-contact.show', $trainee);
    }

    /**
     * Show the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function show(Trainee $trainee)
    {
        return view('tms::trainee.show.emergency_contact', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Trainee $trainee
     * @return Response
     */
    public function edit(Trainee $trainee)
    {
        return view('tms::trainee.edit.emergency_contact', compact('trainee'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Trainee $trainee
     * @return void
     */
    public function update(Request $request, Trainee $trainee)
    {
        $success = $this->traineeEmergencyContactService->updateContact($trainee, $request->all());
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
