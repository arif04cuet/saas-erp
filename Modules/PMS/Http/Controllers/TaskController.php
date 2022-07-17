<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Task;
use App\Services\TaskService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;
use Modules\PMS\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    private $taskService;
    private $module = 'pms';

    /**
     * TaskController constructor.
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(Project $project)
    {
        $action = route($this->module . '-tasks.store', $project->id);

        return view('task.create')->with([
            'action' => $action,
            'taskable' => $project,
            'module' => $this->module
        ]);
    }

    public function store(TaskRequest $request, Project $project)
    {
        if ($this->taskService->store($project, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('project.show', $project->id);
    }

    public function show(Project $project, Task $task)
    {
        return view('task.show')->with([
            'task' => $task,
            'taskable' => $project,
            'module' => $this->module,
        ]);
    }

    public function edit(Project $project, Task $task)
    {
        $action = route($this->module . '-tasks.update', [$project->id, $task->id]);
        $is_edit = true;
        return view('task.edit')->with([
            'action' => $action,
            'task' => $task,
            'taskable' => $project,
            'module' => $this->module,
            'is_edit' => $is_edit

        ]);
    }

    public function update(TaskRequest $request, Project $project, Task $task)
    {
        if ($this->taskService->updateTask($project, $task, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('project.show', $project->id);
    }

    public function destroy(Project $project, Task $task)
    {
        if ($this->taskService->deleteTask($task)) {
            Session::flash('success', trans('labels.delete_success'));
        } else {
            Session::flash('error', trans('labels.delete_fail'));
        }

        return redirect()->route('project.show', $project->id);
    }
}
