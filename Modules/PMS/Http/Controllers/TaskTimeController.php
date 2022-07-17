<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;

class TaskTimeController extends Controller
{
    /**
     * @var TaskService
     */
    private $taskService;

    /**
     * TaskTimeController constructor.
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function  update(Request $request, Project $project, Task $task)
    {
        if ($this->taskService->updateTaskTime($task)) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('project.show', $project->id);
    }
}
