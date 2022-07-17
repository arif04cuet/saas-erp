<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/10/19
 * Time: 5:52 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TrainingBatchCourse;
use Modules\TMS\Repositories\TrainingBatchCourseRepository;

class TrainingBatchCourseService
{
    use CrudTrait;
    private $repository;

    /**
     * TrainingBatchCourseService constructor.
     * @param TrainingBatchCourseRepository $repository
     */
    public function __construct(TrainingBatchCourseRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function syncRooms(TrainingBatchCourse $batch, array $data)
    {
        try {
            DB::beginTransaction();

            $batch->rooms()->sync($data['rooms']);

            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error(get_class($this) . ": {$exception->getMessage()}");
            return false;
        }
    }
}