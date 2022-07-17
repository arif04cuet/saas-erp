<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Services\MonthlyUpdateService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;

class ProjectMonthlyUpdateController extends Controller
{
    private $module;
    /**
     * @var MonthlyUpdateService
     */
    private $monthlyUpdateService;
    /**
     * @var TaskService
     */
    private $taskService;

    /**
     * ProjectMonthlyUpdateController constructor.
     * @param MonthlyUpdateService $monthlyUpdateService
     */
    public function __construct(MonthlyUpdateService $monthlyUpdateService, TaskService $taskService)
    {
        $this->module = 'pms';
        $this->monthlyUpdateService = $monthlyUpdateService;
        $this->taskService = $taskService;
    }

    public function create(Project $project)
    {
        $action = route($this->module . '-monthly-updates.store', $project->id);

        return view('monthly-update.create')->with([
            'monthlyUpdatable' => $project,
            'module' => $this->module,
            'action' => $action,
        ]);
    }

    public function store(Request $request, Project $project)
    {
        if ($this->monthlyUpdateService->store($project, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('project.show', $project->id);
    }

    public function show(Project $project, MonthlyUpdate $monthlyUpdate)
    {
        $tasks = $this->taskService->findIn('id', explode(', ', $monthlyUpdate->tasks));
        return view('monthly-update.show')->with([
            'module' => $this->module,
            'monthlyUpdatable' => $project,
            'monthlyUpdate' => $monthlyUpdate,
            'tasks' => $tasks
        ]);
    }

    public function edit(Project $project, MonthlyUpdate $monthlyUpdate)
    {
        $action = route($this->module . '-monthly-updates.update', [$project->id, $monthlyUpdate->id]);

        return view('monthly-update.edit')->with([
            'module' => $this->module,
            'action' => $action,
            'monthlyUpdatable' => $project,
            'monthlyUpdate' => $monthlyUpdate,
        ]);
    }

    public function update(Request $request, Project $project, MonthlyUpdate $monthlyUpdate)
    {
        if ($this->monthlyUpdateService->updateEntry($monthlyUpdate, $project, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('project.show', $project->id);
    }
}
