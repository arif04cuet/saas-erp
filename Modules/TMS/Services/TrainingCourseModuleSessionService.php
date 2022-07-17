<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourseModule;
use Modules\TMS\Repositories\TrainingCourseModuleSessionRepository;

class TrainingCourseModuleSessionService
{
    use CrudTrait;

    /**
     * @var $repository
     */
    private $repository;

    public function __construct(
        TrainingCourseModuleSessionRepository $trainingCourseModuleSessionRepository
    )
    {
        $this->repository = $trainingCourseModuleSessionRepository;
        $this->setActionRepository($this->repository);
    }

    /**
     * @param TrainingCourseModule $module
     * @param array $data
     * @return mixed
     */
    public function createOrUpdate(TrainingCourseModule $module, $data = [])
    {
        return DB::transaction(function () use ($module, $data) {

            $sessionIdsShouldBeUpdated = $this->getSessionIdsToUpdate($data ?: []);

            $deletes = $this->getSessionsToDelete($module, $sessionIdsShouldBeUpdated)
                ->each(function ($delete) {
                    $delete->delete();
                });

            if (!empty($data)) {
                $updateOrSaves = collect($data)->each(function ($session) use ($module) {
                    if (!isset($session['speaker_expire_timeline'])){
                        $session['speaker_expire_timeline'] = env('SPEAKER_EVALUATION_DEADLINE')
                            ?? config('speaker-evaluation.default-time');
                    }
                    $module->sessions()->updateOrCreate(['id' => $session['id']], $session);
                });

                return $updateOrSaves;
            }

            return $deletes;

        });
    }

    /**
     * @param TrainingCourseModule $module
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function sessions(TrainingCourseModule $module)
    {
        $sessions = $this->repository->findBy([
            'training_course_module_id' => $module->id
        ]);

        return $sessions;
    }

    /**
     * @param array $data
     * @return array
     */
    private function getSessionIdsToUpdate(array $data = []): array
    {
        return array_filter(array_column($data, 'id'));
    }

    /**
     * @param $module
     * @param $sessionIdsShouldBeUpdated
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getSessionsToDelete($module, $sessionIdsShouldBeUpdated)
    {
        return $this->repository->findBy([
            'training_course_module_id' => $module->id
        ])->filter(function ($session) use ($sessionIdsShouldBeUpdated) {
            return !in_array($session->id, $sessionIdsShouldBeUpdated);
        });
    }
}
