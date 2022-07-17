<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Repositories\TraineeWhoDidNotSubmitSpeakerEvaluationRepository;

class TraineeWhoDidNotSubmitSpeakerEvaluationService
{
    use CrudTrait;

    private $trainingCourseModuleBatchSessionScheduleService;

    public function __construct(
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService,
        TraineeWhoDidNotSubmitSpeakerEvaluationRepository $traineeWhoDidNotSubmitSpeakerEvaluationRepository
    ) {
        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
        $this->setActionRepository($traineeWhoDidNotSubmitSpeakerEvaluationRepository);
    }

    /**
     * @param Collection $data
     * @param array $defaultSelectedValues
     * @return Collection
     */
    public function getIndexData(Collection $data, array $defaultSelectedValues)
    {
        $sessionSelectedValue = $defaultSelectedValues['session_selected_value'];
        if (is_null($sessionSelectedValue)) {
            return collect();
        }
        if ($data->has($sessionSelectedValue)) {
            return $data[$sessionSelectedValue];
        } else {
            return collect();
        }
    }

    /**
     * @param $trainingCourseId
     * @param array $sessionIds
     * @return mixed
     */
    public function loadData($trainingCourseId, array $sessionIds)
    {
        $training = $this->getTrainingFromCourse($trainingCourseId);
        $trainees = $this->actionRepository->getTraineesOfTraining($training->id);
        $scheduledSessions = $this->actionRepository->getScheduledSessions($sessionIds);
        // for each schedule session, include its trainee who didnt evaluate
        return $scheduledSessions->map(function ($ss) use ($trainees, $trainingCourseId) {
            return $this->trainingCourseModuleBatchSessionScheduleService->getTraineesWhoDidntEvaluate(
                $trainees,
                $ss
            )->map(function ($d) use ($ss, $trainingCourseId) {
                return (object)[
                    'training_course_id' => $trainingCourseId,
                    'training_course_module_id' => optional($ss->module)->id ?? null,
                    'training_course_module_session_id' => $ss->id,
                    'training_course_module_session_batch_id' => optional($ss->schedule)->batch->id ?? null,
                    'english_name' => $d->english_name ?? trans('labels.not_found'),
                    'bangla_name' => $d->bangla_name ?? trans('labels.not_found'),
                    'email' => $d->email ?? trans('labels.not_found'),
                    'mobile' => $d->mobile ?? trans('labels.not_found'),
                ];
            });
        })->flatten()->groupBy('training_course_module_session_id');
    }

    /**
     * @param null $courseId
     * @return array
     */
    public function loadJsFilterOptions($courseId = null)
    {
        $trainingCourse = null;
        if (is_null($courseId)) {
            $trainingCourse = TrainingCourse::latest('created_at')->with(
                'modules.sessions',
                'batches'
            )->first();
        } else {
            $trainingCourse = TrainingCourse::with(
                'modules.sessions.assessments',
                'batches'
            )->find($courseId);
        }
        $modules = $trainingCourse->modules->filter(function ($module) {
            return $module->sessions->count();
        });
        $batches = $trainingCourse->batches ?? [];
        $sessions = $this->prepareSessionArrayFromModules($modules);
        // dd($modules);
        $modulesWhichHasSessionAndAssessments = array_keys($sessions); // sessions are grouped by modules
        $modules = $modules->filter(function ($value) use ($modulesWhichHasSessionAndAssessments) {
            return in_array($value->id, $modulesWhichHasSessionAndAssessments);
        });
        $trainingCourses = $this->getAllTrainingCourseForDropdown();
        return [
            'selected_training_course' => $trainingCourse->id,
            'training_course_for_dropdown' => $trainingCourses,
            'module_for_dropdown' => $modules->pluck('title', 'id'),
            'batches_for_dropdown' => $batches->pluck('title', 'id'),
            'sessions_by_module' => $sessions
        ];
    }

    public function getAllTrainingCourseForDropdown()
    {
        return TrainingCourse::all()->each(function ($t) {
            $t->name = $t->getName() ?? trans('labels.not_found');
        })->pluck('name', 'id');
    }

    public function getDropdownSelectedValues(array $jsFilterOptions)
    {
        $trainingCourseSelectedValue = $jsFilterOptions['selected_training_course'] ?? null;
        $moduleSelectedValue = array_key_first($jsFilterOptions['module_for_dropdown']->toArray()) ?? null;
        $batchSelectedValue = array_key_first($jsFilterOptions['batches_for_dropdown']->toArray()) ?? null;
        // selecting first session of first module , could have write more simply i agree
        if (!array_key_exists($moduleSelectedValue, $jsFilterOptions['sessions_by_module'])) {
            $sessionSelectedValue = null;
        } else {
            $sessionSelectedValue = array_key_first($jsFilterOptions['sessions_by_module'][array_key_first($jsFilterOptions['sessions_by_module'])]->toArray()) ?? null;
        }
        return [
            'training_course_selected_value' => $trainingCourseSelectedValue,
            'module_selected_value' => $moduleSelectedValue,
            'batch_selected_value' => $batchSelectedValue,
            'session_selected_value' => $sessionSelectedValue
        ];
    }

    //------------------------------------------------------------------------------------
    //                           private function
    //-------------------------------------------------------------------------------------
    /**
     * @param $modules
     * @return array
     */
    private function prepareSessionArrayFromModules(
        $modules
    ) {
        $sessionArray = [];
        foreach ($modules as $module) {
            $sessions = $module->sessions->filter(function ($session) {
                // dd($session);
                dd($session->assessments->count());
            });
            if ($sessions->count()) {
                $sessionArray[$module->id] = $sessions->pluck('title', 'id');
            }
        }
        return $sessionArray;
    }

    private
    function getTrainingFromCourse(
        $trainingCourseId
    ) {
        try {
            $trainingCourse = $this->actionRepository->getTrainingCourse($trainingCourseId);
            $training = optional($trainingCourse)->training;
            if (is_null($training)) {
                throw  new \Exception('Training Not Found For Session Id: ' . $trainingCourseId->id);
            }
            return $training;
        } catch (\Exception $exception) {
            Log::error(get_class($this) . " Message: " . $exception->getMessage() . ' :trace '
                . $exception->getTraceAsString());
            return null;
        }
    }
}
