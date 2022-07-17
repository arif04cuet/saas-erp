<?php


namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\JobCircular;

class JobCircularRepository extends AbstractBaseRepository
{
    protected $modelName = JobCircular::class;


    public function getUniqueJobNatures()
    {
        $jobNatures = $this->getModel()->newQuery()
            ->distinct('job_nature')->pluck('job_nature');
        return $jobNatures;
    }


}
