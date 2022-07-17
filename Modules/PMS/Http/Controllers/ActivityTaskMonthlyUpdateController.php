<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Services\MonthlyUpdateService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectActivity;
use Modules\PMS\Services\ProjectActivityService;

class ActivityTaskMonthlyUpdateController extends Controller
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
     * @var ProjectActivityService
     */
    private $projectActivityService;

    /**
     * ProjectMonthlyUpdateController constructor.
     * @param ProjectActivityService $projectActivityService
     * @param MonthlyUpdateService $monthlyUpdateService
     * @param TaskService $taskService
     */
    public function __construct(
        ProjectActivityService $projectActivityService,
        MonthlyUpdateService $monthlyUpdateService,
        TaskService $taskService
    ) {
        $this->module = 'pms';
        $this->projectActivityService = $projectActivityService;
        $this->monthlyUpdateService = $monthlyUpdateService;
        $this->taskService = $taskService;
    }

    public function create(Project $project, $activityId)
    {
        $activity = $this->projectActivityService->findOne($activityId);

        $action = route('pms-activity-task-monthly-updates.store', [$project->id, $activity->id]);
//        dd(view('project-activity.monthly-update.create'));
//        return view('project-activity.monthly-update.create');

        return view('pms::project-activity.monthly-update.create')->with([
            'monthlyUpdatable' => $activity,
            'module' => $this->module,
            'action' => $action,
            'project' => $project
        ]);
    }

    public function store(Request $request, Project $project, $activityId)
    {
        $activity = $this->projectActivityService->findOne($activityId);

        if ($this->monthlyUpdateService->store($activity, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('pms-activity.show', [$project->id, $activityId]);
    }

    public function show(Project $project, $activityId, MonthlyUpdate $monthlyUpdate)
    {
        $activity = $this->projectActivityService->findOne($activityId);
        $tasks = $this->taskService->findIn('id', explode(', ', $monthlyUpdate->tasks));
        return view('pms::project-activity.monthly-update.show')->with([
            'module' => $this->module,
            'monthlyUpdatable' => $activity,
            'monthlyUpdate' => $monthlyUpdate,
            'tasks' => $tasks,
            'project' => $project
        ]);
    }

    public function edit(Project $project, $activityId, MonthlyUpdate $monthlyUpdate)
    {
        $activity = $this->projectActivityService->findOne($activityId);

        $action = route('pms-activity-task-monthly-updates.update', [$project->id, $activityId, $monthlyUpdate->id]);

        return view('pms::project-activity.monthly-update.edit')->with([
            'module' => $this->module,
            'action' => $action,
            'monthlyUpdatable' => $activity,
            'monthlyUpdate' => $monthlyUpdate,
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project, $activityId, MonthlyUpdate $monthlyUpdate)
    {
        $activity = $this->projectActivityService->findOne($activityId);

        if ($this->monthlyUpdateService->updateEntry($monthlyUpdate, $activity, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }
        return redirect()->route('pms-activity.show', [$project->id, $activityId]);
    }
}
