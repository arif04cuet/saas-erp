<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Task;
use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectActivity;
use Modules\PMS\Http\Requests\TaskRequest;
use Modules\PMS\Services\ProjectActivityService;
use Modules\TMS\Services\TmsSectorService;

class ProjectActivityController extends Controller
{
    /**
     * @var ProjectActivityService
     */
    private $projectActivityService;
    private $module = 'pms';
    /**
     * @var TaskService
     */
    private $taskService;

    /**
     * TmsSectorController constructor.
     * @param ProjectActivityService $projectActivityService
     * @param TaskService $taskService
     */
    public function __construct(
        ProjectActivityService $projectActivityService,
        TaskService $taskService

    ) {
        $this->projectActivityService = $projectActivityService;
        $this->taskService = $taskService;
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
        $ganttChart = $this->taskService->getActivityTasksGanttChartData($activity);

//        dd($activity->monthlyUpdates);

//        $ganttChart = [
//                        [
//                            "id" => 171,
//                            "text" => "",
//                            "start_date" => "2021-03-11",
//                            "duration" => 50,
//                            "progress" => 1.0,
//                            "parent" => 0,
//                            "planned_start" => "2021-03-11",
//                            "planned_end" => "2021-04-30",
//                        ], [
//                           "id" => 172,
//                           "text" => "Task 2",
//                           "start_date" => "2021-03-11",
//                           "duration" => 26,
//                           "progress" => 0.01,
//                           "parent" => 0,
//                           "planned_start" => "2021-03-11",
//                           "planned_end" => "2021-04-06"
//                       ]
//                    ];

//        dd($ganttChart);

        return view('pms::project-activity.show', compact('activity', 'project', 'ganttChart'));
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

    public function taskCreate(Project $project, $activityId)
    {
        $activity = $this->projectActivityService->findOne($activityId);
        $action = route('pms-activity-tasks.store', [$project->id, $activity->id]);

        return view('pms::project-activity.task.create')->with([
            'action' => $action,
            'taskable' => $activity,
            'module' => $this->module
        ]);
    }

    public function taskStore(TaskRequest $request, Project $project, $activityId)
    {
        $activity = $this->projectActivityService->findOne($activityId);

//        dd($request->all());

        if ($this->taskService->store($activity, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('pms-activity.show', [$project->id, $activityId]);
    }

    public function taskShow(Project $project, $activityId, Task $task)
    {
        $projectActivity = $this->projectActivityService->findOne($activityId);
        return view('pms::project-activity.task.show')->with([
            'task' => $task,
            'taskable' => $projectActivity,
            'module' => $this->module,
            'project' => $project
        ]);
    }

    public function taskEdit(Project $project, $activityId, Task $task)
    {
        $projectActivity = $this->projectActivityService->findOne($activityId);
        $action = route('pms-activity-tasks.update', [$project->id, $activityId, $task->id]);
        $is_edit = true;
        return view('pms::project-activity.task.edit')->with([
            'action' => $action,
            'task' => $task,
            'taskable' => $projectActivity,
            'module' => $this->module,
            'is_edit' => $is_edit
        ]);
    }

    public function taskUpdate(TaskRequest $request, Project $project, $activityId, Task $task)
    {
        $projectActivity = $this->projectActivityService->findOne($activityId);
        if ($this->taskService->updateTask($projectActivity, $task, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('pms-activity.show', [$project->id, $activityId]);
    }

    public function  timeUpdate(Request $request, Project $project, $activityId, Task $task)
    {
        if ($this->taskService->updateTaskTime($task)) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('pms-activity.show', [$project->id, $activityId]);
    }

    public function taskDestroy(Project $project, $activityId, Task $task)
    {
        if ($this->taskService->deleteTask($task)) {
            Session::flash('success', trans('labels.delete_success'));
        } else {
            Session::flash('error', trans('labels.delete_fail'));
        }

        return redirect()->route('pms-activity.show', [$project->id, $activityId]);
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
