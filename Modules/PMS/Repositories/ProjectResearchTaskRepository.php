<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/18/18
 * Time: 5:24 PM
 */

namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\ProjectResearchTask;
use Modules\PMS\Entities\Task;
use Modules\PMS\Entities\TaskAttachments;


class ProjectResearchTaskRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectResearchTask::class;

    public function getProjectTask($projectId)
    {
        return $this->model->whereHas('project', function($query) use($projectId) {
            $query->where('id', $projectId)->where('type', 'project');
        })->get();
    }

    public function getResearchTask($researchId)
    {
        return $this->model->whereHas('research', function($query) use($researchId) {
            $query->where('id', $researchId)->where('type', 'research');
        })->get();
    }

    public function saveAttachments($taskId, $data)
    {
        $task = $this->findOrFail($taskId);
        $save = $task->attachments()->create($data);

        return $save->getAttribute('id');
    }

    public function deleteAttachment($attachmentId)
    {
        return TaskAttachments::where('id', $attachmentId)->delete();
    }

    public function saveTaskName($taskNameData)
    {
         $task = new Task;
         return $task->insertGetId($taskNameData);
    }
}
