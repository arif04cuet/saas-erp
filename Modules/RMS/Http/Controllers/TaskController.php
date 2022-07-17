<?php

namespace Modules\RMS\Http\Controllers;

use App\Entities\Task;
use App\Services\TaskService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Http\Requests\TaskRequest;
use Modules\RMS\Entities\Research;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    private $taskService;

    /**
     * TaskController constructor.
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(Research $research)
    {
        $action = route('rms-tasks.store', $research->id);
        $module = 'rms';

        return view('task.create', compact('action', 'module'))->with([
            'taskable' => $research
        ]);
    }

    public function store(TaskRequest $request, Research $research)
    {
        if ($this->taskService->store($research, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('research.show', $research->id);
    }

    public function show(Research $research, Task $task)
    {
        $module = 'rms';

        return view('task.show', compact('task', 'module'))->with([
            'taskable' => $research
        ]);
    }

    public function edit(Research $research, Task $task)
    {
        $action = route('rms-tasks.update', [$research->id, $task->id]);
        $module = 'rms';
        $is_edit=true;
        return view('task.edit', compact('task', 'action', 'module'))->with([
            'taskable' => $research,
            'is_edit' => $is_edit
        ]);
    }

    public function update(TaskRequest $request, Research $research, Task $task)
    {
        if ($this->taskService->updateTask($research, $task, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('research.show', $research->id);
    }

    public function destroy(Research $research, Task $task)
    {
        if ($this->taskService->deleteTask($task)) {
            Session::flash('success', trans('labels.delete_success'));
        } else {
            Session::flash('error', trans('labels.delete_fail'));
        }

        return redirect()->route('research.show', $research->id);
    }
}
