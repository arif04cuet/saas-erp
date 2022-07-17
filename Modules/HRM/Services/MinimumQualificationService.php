<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 9/1/19
 * Time: 5:10 PM
 */

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\JobCircularQualificationRule;
use Modules\HRM\Repositories\MinimumQualificationRepository;

class MinimumQualificationService
{
    use CrudTrait;

    /**
     * @var MinimumQualificationRepository
     */
    private $minimumQualificationRepository;

    public function __construct(MinimumQualificationRepository $minimumQualificationRepository)
    {
        /** @var MinimumQualificationRepository $minimumQualificationRepository */
        $this->minimumQualificationRepository = $minimumQualificationRepository;
        $this->setActionRepository($minimumQualificationRepository);
    }

    public function store(array $data, $jobCircular)
    {
        return DB::transaction(function () use ($data, $jobCircular) {
            $data = $this->prepareData($data);
            $data['job_circular_id'] = $jobCircular->id;
            $qualificationRule = $jobCircular->qualificationRule()->updateOrCreate(['job_circular_id' => $jobCircular->id], $data);
            return $qualificationRule;
        });
    }

    private function prepareData($data = [])
    {
        $obj = new JobCircularQualificationRule();
        foreach ($obj->getFillable() as $key => $val) {
            if(!isset($data[$val])) {
                $data[$val] = null;
            }
        }

        return $data;
    }
}