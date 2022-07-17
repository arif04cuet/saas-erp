<?php


namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectAssignedRole;

class ProjectAssignedRoleRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectAssignedRole::class;


    public function updateOrCreate(array $data)
    {
        return ProjectAssignedRole::query()->updateOrCreate(
            [
                'project_id' => $data['project_id']
            ],
            [
                'project_director_id' => $data['project_director_id'] ?? null,
                'project_sub_director_id' => $data['project_sub_director_id'] ?? null
            ]
        );

    }

}
