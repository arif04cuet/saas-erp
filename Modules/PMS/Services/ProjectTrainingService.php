<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/27/19
 * Time: 12:06 PM
 */

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Repositories\ProjectTrainingRepository;

class ProjectTrainingService
{
    use CrudTrait;

    /**
     * @var ProjectTrainingRepository
     */
    private $projectTrainingRepository;

    public function __construct(ProjectTrainingRepository $projectTrainingRepository)
    {
        $this->projectTrainingRepository = $projectTrainingRepository;
        $this->setActionRepository($projectTrainingRepository);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $projectTraining = $this->save($data);
            return $projectTraining;
        });
    }

}