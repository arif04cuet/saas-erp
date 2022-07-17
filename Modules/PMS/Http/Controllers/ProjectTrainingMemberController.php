<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectTraining;
use Modules\PMS\Services\ProjectTrainingMemberService;

class ProjectTrainingMemberController extends Controller
{
    /**
     * @var ProjectTrainingMemberService
     */
    private $projectTrainingMemberService;

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(ProjectTrainingMemberService $projectTrainingMemberService)
    {
        $this->projectTrainingMemberService = $projectTrainingMemberService;
    }

    public function index(Project $project, ProjectTraining $training)
    {
        $members = array();

        $trainingMembers = $training->members->pluck('member_id');

        foreach ($project->organizations as $organization) {
            $members = array_merge($organization->members->whereNotIn('id', $trainingMembers)->toArray(), $members);
        }

        return view('pms::project.training.members.index', compact('members', 'project', 'training'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->projectTrainingMemberService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        $trainingId = $request->input('training_id');
        $projectId = $request->input('project_id');

        return redirect()->route('project-training.show', [$projectId, $trainingId]);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('pms::show');
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
