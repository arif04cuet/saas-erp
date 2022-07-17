<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\ProjectActivityDetailsService;
use Modules\PMS\Services\ProjectActivityService;
use Modules\TMS\Services\TmsSectorService;

class ProjectActivityDetailsController extends Controller
{
    /**
     * @var ProjectActivityDetailsService
     */
    private $activityDetailsService;

    /**
     * ProjectActivityDetailsController constructor.
     * @param ProjectActivityDetailsService $activityDetailsService
     */
    public function __construct(ProjectActivityDetailsService $activityDetailsService)
    {
        $this->activityDetailsService = $activityDetailsService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $sectors = $this->tmsSectorService->findAll();
        return view('tms::budget.sector.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Project $project
     * @return Factory|Response|View
     */
    public function create(Project $project)
    {
        $page = 'create';
        return view('pms::project-activity.create', compact('page', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Project $project
     * @return RedirectResponse|Response
     */
    public function store(Request $request, Project $project)
    {
        $save = $this->projectActivityService->store($request->all(), $project->id);

        if ($save) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('project.show', $project->id);
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param Project $project
     * @param int $id
     * @return Factory|Response|View
     */
    public function show(Project $project, $id)
    {
        $activity = $this->projectActivityService->findOne($id);
        return view('pms::project-activity.show', compact('activity', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Project $project
     * @param int $id
     * @return Factory|Response|View
     */
    public function edit(Project $project, $id)
    {
        $activity = $this->projectActivityService->findOne($id);
        $page = 'edit';
        return view('pms::project-activity.create', compact('activity', 'page', 'project'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Project $project, $id)
    {
        $update = $this->projectActivityService->updateActivity($request->all(), $id);
        if ($update) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('project.show', $project->id);
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->tmsSectorService->deleteSector($id);
        return redirect()->back();
    }
}
