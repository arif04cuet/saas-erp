<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectTraining;
use Modules\PMS\Services\ProjectTrainingService;

class ProjectTrainingController extends Controller
{

    /**
     * @var ProjectTrainingService
     */
    private $projectTrainingService;

    public function __construct(ProjectTrainingService $projectTrainingService)
    {
        $this->projectTrainingService = $projectTrainingService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Project $project)
    {
        $trainings =  $project->projectTrainings;
        return view('pms::project.training.index', compact('project', 'trainings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Project $project)
    {
        return view('pms::project.training.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, Project $project)
    {
        $this->projectTrainingService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('project-training.index', $project->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Project $project, ProjectTraining $training)
    {
        $members = $training->members;
        return view('pms::project.training.show', compact('project','training', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
