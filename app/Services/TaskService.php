<?php
/**
 * Created by PhpStorm.
 * User: siam
 * Date: 2/2/19
 * Time: 9:35 PM
 */

namespace App\Services;


use App\Entities\Task;
use App\Entities\TaskAttachment;
use App\Repositories\TaskRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskService
{

    use CrudTrait;
    use FileTrait;
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * TaskService constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->setActionRepository($taskRepository);
    }

    public function store($taskable, array $data)
    {
        return DB::transaction(function () use ($taskable, $data) {
            $task = $taskable->tasks()->create($data);

            $this->syncTaskAttachments($taskable, $task, $data);

            return $task;
        });
    }

    public function updateTask($taskable, Task $task, array $data)
    {
        return DB::transaction(function () use ($data, $taskable, $task) {
            $this->syncTaskAttachments($taskable, $task, $data);
            return $task->update($data);
        });
    }

    public function deleteTask(Task $task)
    {
        return DB::transaction(function () use ($task) {
            $task->attachments()->delete();

            return $task->delete();
        });
    }

    public function updateTaskTime(Task $task)
    {
        if ($task->actual_start_time) {
            $task->actual_end_time = Carbon::now();
        } else {
            $task->actual_start_time = Carbon::now();
        }

        return $task->save();
    }

    /**
     * Get Data for DTHMLXGantt Chart of Tasks
     *
     * @param $tasks
     * @return array
     */
    public function getTasksGanttChartData($tasks)
    {
        $chartData = [];
        foreach ($tasks as $task) {

            if ($task->expected_start_time && $task->expected_end_time && $task->actual_start_time) {

                $manipulatedTaskData = $this->getManipulatedTaskData($task);
                array_push($chartData, array(
                    "id" => $task->id,
                    "text" => $task->name,
                    "start_date" => $manipulatedTaskData->actualStartTime,
                    "duration" => $manipulatedTaskData->duration,
                    "progress" => 0,
                    "parent" => 0,
                    //"deadline" => $manipulatedTaskData->deadline,
                    "planned_start" => $task->expected_start_time,
                    "planned_end" => $task->expected_end_time,
                ));
            }
        }
        return $chartData;
    }

    /**
     * @param $activity
     * @return array
     */
    public function getActivityTasksGanttChartData($activity): array
    {
        $chartData = [];
        foreach ($activity->tasks as $task) {

            if ($task->expected_start_time && $task->expected_end_time && $task->actual_start_time) {

                $manipulatedTaskData = $this->getManipulatedTaskData($task);
                array_push($chartData, array(
                    "id" => $task->id,
                    "text" => $task->name,
                    "start_date" => $manipulatedTaskData->actualStartTime,
                    "duration" => $manipulatedTaskData->duration,
                    "progress" => $this->getManipulatedTaskProgress($activity, $task),
                    "parent" => 0,
                    //"deadline" => $manipulatedTaskData->deadline,
                    "planned_start" => $task->expected_start_time,
                    "planned_end" => $task->expected_end_time,
                ));
            }
        }
        return $chartData;
    }

    /**
     * @param $activity
     * @param $task
     */
    private function getManipulatedTaskProgress($activity, $task)
    {
        $taskMonthlyUpdate = $activity->monthlyUpdates;
        $totalAchievement = 0;

        foreach ($taskMonthlyUpdate as $update) {
            if ($update->tasks == $task->id) {
                $totalAchievement += $update->achievement;
            }
        }
        $percentage = 100;
        $progress = (float) ($totalAchievement / $task->amount * $percentage) / 100;
        return  number_format($progress, 2);
    }

    /**
     * @param $task
     * @return object
     */
    private function getManipulatedTaskData($task)
    {
        $data['duration'] = 0;
        //$data['deadline'] = $task->expected_end_time;
        $data['actualStartTime'] = $task->actual_start_time ? : $task->expected_start_time;

        if ($task->actual_start_time && $task->actual_end_time){
            $data['duration'] = Carbon::parse($task->actual_start_time)->diffInDays($task->actual_end_time);
        } else if (!$task->actual_end_time){
            $data['duration'] = Carbon::parse($task->expected_start_time)->diffInDays($task->expected_end_time);
        }

        return (object) $data;
    }

    /**
     * @param $taskable
     * @param $task
     * @param $data
     */
    private function syncTaskAttachments($taskable, $task, $data)
    {
        if (array_key_exists('deleted_attachments', $data)) {
            TaskAttachment::destroy($data['deleted_attachments']);
        }

        if (array_key_exists('attachments', $data)) {
            foreach ($data['attachments'] as $file) {
                $filePath = $this->upload($file, 'research/' . $taskable->title . '/tasks/' . $task->name);
                $task->attachments()->create([
                    'path' => $filePath,
                    'name' => $file->getClientOriginalName(),
                    'ext' => $file->getClientOriginalExtension(),
                ]);
            }
        }
    }

    public function findIn($key, array $values, $relation = null, array $orderBy = null)
    {
        return $this->taskRepository->findIn($key, $values, $relation, $orderBy);
    }

    public function getTasksBarChartData()
    {
        $tasks = new Task();
        $Rols =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Review of literature')->get();
        $Pws =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Proposal writing')->get();
        $Qps =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Questionnaire preparation')->get();
        $Q_pretests =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Questionnaire pretesting')->get();
        $Dcs =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Data collection')->get();
        $Dts =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Data tabulation')->get();
        $Rws =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Report writing')->get();
        $Drss =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Draft report submission')->get();
        $Irdcs =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Incorporating research division comments')->get();
        $Ffrss =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'First final report submission')->get();
        $Rfrs =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Received final report')->get();
        $Sers =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Sending external reviewer')->get();
        $Cfers =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Comments from external reviewer')->get();
        $Strrs =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Send to respective researcher')->get();
        $Afrs =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Accepted final report')->get();
        $Sfps =  $tasks->where('taskable_type', '=', 'research')->where('name', '=', 'Send for publication')->get();

        $planned[] = $Rols->filter(function ($Rol) {
            return Carbon::parse($Rol->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Pws->filter(function ($Pw) {
            return Carbon::parse($Pw->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Qps->filter(function ($Qp) {
            return Carbon::parse($Qp->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Q_pretests->filter(function ($Q_pretests) {
            return Carbon::parse($Q_pretests->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Dcs->filter(function ($Dcs) {
            return Carbon::parse($Dcs->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Dts->filter(function ($Dts) {
            return Carbon::parse($Dts->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Rws->filter(function ($Rws) {
            return Carbon::parse($Rws->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Drss->filter(function ($Drss) {
            return Carbon::parse($Drss->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Irdcs->filter(function ($Irdcs) {
            return Carbon::parse($Irdcs->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Ffrss->filter(function ($Ffrss) {
            return Carbon::parse($Ffrss->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Rfrs->filter(function ($Rfrs) {
            return Carbon::parse($Rfrs->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Sers->filter(function ($Sers) {
            return Carbon::parse($Sers->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Cfers->filter(function ($Cfers) {
            return Carbon::parse($Cfers->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Strrs->filter(function ($Strrs) {
            return Carbon::parse($Strrs->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Afrs->filter(function ($Afrs) {
            return Carbon::parse($Afrs->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $planned[] = $Sfps->filter(function ($Sfps) {
            return Carbon::parse($Sfps->expected_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();


        $achieved[] = $Rols->filter(function ($Rol) {
            return Carbon::parse($Rol->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Pws->filter(function ($Pws) {
            return Carbon::parse($Pws->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Qps->filter(function ($Qps) {
            return Carbon::parse($Qps->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Q_pretests->filter(function ($Q_pretests) {
            return Carbon::parse($Q_pretests->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Dcs->filter(function ($Dcs) {
            return Carbon::parse($Dcs->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Dts->filter(function ($Dts) {
            return Carbon::parse($Dts->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Rws->filter(function ($Rws) {
            return Carbon::parse($Rws->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Drss->filter(function ($Drss) {
            return Carbon::parse($Drss->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Irdcs->filter(function ($Irdcs) {
            return Carbon::parse($Irdcs->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Ffrss->filter(function ($Ffrss) {
            return Carbon::parse($Ffrss->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Rfrs->filter(function ($Rfrs) {
            return Carbon::parse($Rfrs->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Sers->filter(function ($Sers) {
            return Carbon::parse($Sers->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Cfers->filter(function ($Cfers) {
            return Carbon::parse($Cfers->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Strrs->filter(function ($Strrs) {
            return Carbon::parse($Strrs->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Afrs->filter(function ($Afrs) {
            return Carbon::parse($Afrs->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        $achieved[] = $Sfps->filter(function ($Sfps) {
            return Carbon::parse($Sfps->actual_end_time)->format('m y') == Carbon::now()->subMonth()->format('m y');
        })->count();

        return [$planned, $achieved];
    }

    public function getAllResearchTasks()
    {
        $tasks = new Task();
        return $tasks->where('taskable_type', '=', 'research')->whereNull('actual_end_time')->whereNotNull('actual_start_time')->get();
    }
}
