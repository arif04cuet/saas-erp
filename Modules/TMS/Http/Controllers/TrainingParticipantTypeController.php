<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Services\TrainingParticipantTypeService;
use Illuminate\Support\Facades\Session;

class TrainingParticipantTypeController extends Controller
{
    private $trainingParticipantTypeService;

    public function __construct(TrainingParticipantTypeService $trainingParticipantTypeService)
    {
        $this->trainingParticipantTypeService = $trainingParticipantTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $page = 'create';
        $trainingParticipants = $this->trainingParticipantTypeService->index();
        return view('tms::training.participant.index', compact('trainingParticipants', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::training.participant.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->trainingParticipantTypeService->store($request);
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('trainee-type.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        // return view('training.participant.show');
        $trainingParticipant = $this->trainingParticipantTypeService->find($id);;
        return view('tms::training.participant.show', compact('trainingParticipant'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $page = 'edit';
        $participant = $this->trainingParticipantTypeService->find($id);
        //return $participant;
        return view('tms::training.participant.edit', compact('participant', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->trainingParticipantTypeService->update($id, $request);
        Session::flash('success', trans('labels.update_success'));
        return redirect()->route('trainee-type.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->trainingParticipantTypeService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('trainee-type.index');
    }
}
