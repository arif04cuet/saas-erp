<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectAssignedRole;
use Modules\PMS\Repositories\ProjectAssignedRoleRepository;

class ProjectAssignedRoleService
{
    use CrudTrait;

    public function __construct(ProjectAssignedRoleRepository $projectAssignedRoleRepository)
    {
        $this->setActionRepository($projectAssignedRoleRepository);
    }

    /**
     * @param Project $project
     * @param array $data
     * @return mixed
     */
    public function createOrUpdate(Project $project, array $data)
    {
        $data = $this->prepareData($project, $data);
        return $this->actionRepository->updateOrCreate($data);
    }

    //----------------------------------------------------------------------------------
    //                                  Private Functions
    //----------------------------------------------------------------------------------
    /**
     * @param Project $project
     * @param array $data
     * @return array
     */
    private function prepareData(Project $project, array $data)
    {
        $projectDirectorId = isset($data['project_director_id']) ? $data['project_director_id'] : null;
        $projectSubDirectorId = isset($data['project_sub_director_id']) ? $data['project_sub_director_id'] : null;
        return [
            'project_id' => $project->id,
            'project_director_id' => $projectDirectorId,
            'project_sub_director_id' => $projectSubDirectorId
        ];
    }

}

