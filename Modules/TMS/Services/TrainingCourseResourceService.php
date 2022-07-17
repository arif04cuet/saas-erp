<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseGuest;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Repositories\TrainingCourseResourceRepository;

class TrainingCourseResourceService
{
    use CrudTrait;

    private $trainingCourseResourceRepository;
    private $courseGuestService;

    public function __construct(
        TrainingCourseResourceRepository $trainingCourseResourceRepository,
        TrainingCourseGuestService $courseGuestService
    ) {
        $this->trainingCourseResourceRepository = $trainingCourseResourceRepository;
        $this->setActionRepository($this->trainingCourseResourceRepository);
        $this->courseGuestService = $courseGuestService;
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {
            if (isset($data['guest_resources'])) {
                $guests = $this->courseGuestService->syncGuests($data['guest_resources']);
                $data['guest_resources'] = $guests->toArray();
            }
            if (isset($data['employee_resources'])) {
                $employeeResources = collect($data['employee_resources']);
                $updateResources = $employeeResources->map(function ($employeeResource) use ($course) {
                    $resourceId = isset($employeeResource['resource_id']) ? $employeeResource['resource_id'] : null;
                    $shouldEvaluate = isset($employeeResource['should_be_evaluated']);
                    return $course->resources()->updateOrCreate(
                        [
                            'id' => $resourceId,
                            'reference_entity' => Employee::class
                        ],
                        [
                            'reference_entity' => Employee::class,
                            'reference_entity_id' => $employeeResource['employee_id'],
                            'short_name' => $employeeResource['employee_short_name'],
                            'should_be_evaluated' => $shouldEvaluate
                        ]
                    );
                });
            };

            if (isset($data['guest_resources'])) {
                $guestResources = collect($data['guest_resources']);
                $updatedGuestResources = $guestResources->map(function ($guestResource) use ($course) {
                    $resourceId = isset($guestResource['resource_id']) ? $guestResource['resource_id'] : null;
                    $shouldEvaluate = isset($guestResource['should_be_evaluated']);
                    return $course->resources()->updateOrCreate(
                        [
                            'id' => $resourceId,
                            'reference_entity' => TrainingCourseGuest::class
                        ],
                        [
                            'reference_entity' => TrainingCourseGuest::class,
                            'reference_entity_id' => $guestResource['id'],
                            'short_name' => $guestResource['short_name'],
                            'should_be_evaluated' => $shouldEvaluate
                        ]
                    );
                });
                $updateResources = $updateResources->concat($updatedGuestResources);
            };

            $oldResourceIds = $course->resources()->pluck('id');
            $newResourceIds = $updateResources->pluck('id');

            $removedResourceIds = $oldResourceIds->diff($newResourceIds);

            $course->resources()->whereIn('id', $removedResourceIds)->delete();

            return $course->resources()->get();
        });
    }

    public function courseResourcesDropdown(TrainingCourse $course)
    {
        $resources = $this->trainingCourseResourceRepository->findBy([
            'training_course_id' => $course->id
        ])->mapWithKeys(function ($resource) {
            return [$resource->id => $this->formatResourceName($resource)];
        });

        return $resources;
    }

    private function formatResourceName(TrainingCourseResource $resource)
    {
        return $resource->getResourceName() .
            (
            !empty($resource->short_name)
                ? ' - '
                . $resource->short_name : ''
            );
    }
}

