<?php
/**
 * Created by VS Code.
 * User: Araf
 * Date: 23/04/2022
 * Time: 12:48 PM
 */

namespace Modules\TMS\Services;


use Carbon\Carbon;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingVenue;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseBatch;
use Modules\TMS\Services\TrainingCourseGradeService;
use Modules\TMS\Repositories\TrainingCourseRepository;

class TrainingCourseService
{
    use CrudTrait, FileTrait;

    private $repository;

    private $trainingCourseBatchService;

    private $trainingCourseMarkAllotmentService;

    private $trainingCourseGradeService;

    private const DEFAULT_BATCH_TITLE = "1st Batch";

    /**
     * TrainingCourseService constructor.
     * @param TrainingCourseRepository $repository
     * @param TrainingCourseBatchService $trainingCourseBatchService
     * @param TrainingCourseMarkAllotmentService $trainingCourseMarkAllotmentService
     */
    public function __construct(
        TrainingCourseRepository $repository,
        TrainingCourseBatchService $trainingCourseBatchService,
        TrainingCourseMarkAllotmentService $trainingCourseMarkAllotmentService,
        TrainingCourseGradeService $trainingCourseGradeService
    ) {
        $this->repository = $repository;
        $this->setActionRepository($repository);

        $this->trainingCourseBatchService = $trainingCourseBatchService;
        $this->trainingCourseMarkAllotmentService = $trainingCourseMarkAllotmentService;
        $this->trainingCourseGradeService = $trainingCourseGradeService;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            if (array_key_exists('photo', $data)) {
                $file = $data['photo'];
                $path = $this->upload($file, 'training-course-photos');
                $data['photo'] = $path;
            }

            // $data = $this->formatRequestDates($data);
            $data['registration_deadline'] = Carbon::parse($data['registration_deadline'])->format('Y-m-d');
            $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
            $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
            $course = $this->save($data);

            $batch = $course->batches()->save(new TrainingCourseBatch([
                'title' => self::DEFAULT_BATCH_TITLE,
                'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d'),
                'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d'),
                'no_of_trainees' => optional($course->training)->no_of_trainee
            ]));

            return $course;

        });
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($data, $course) {

            if (array_key_exists('photo', $data)) {
                $file = $data['photo'];
                $path = $this->upload($file, 'training-course-photos');
                $data['photo'] = $path;
            }
            
            // $data = $this->formatRequestDates($data);

            $data['registration_deadline'] = Carbon::parse($data['registration_deadline'])->format('Y-m-d');
            $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
            $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');

            $course = $this->update($course, $data);
            $firstBatch = $course->batches->first();

            if ($firstBatch) {
                $firstBatch->update([
                    'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d'),
                    'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d'),
                ]);
            }

            return $course;

        });
    }

    public function batches(TrainingCourse $trainingCourse)
    {
        return $this->trainingCourseBatchService->findBy(
            [
                'training_course_id' => $trainingCourse->id
            ]
        );
    }

    public function markAllotments(TrainingCourse $trainingCourse)
    {
        return $this->trainingCourseMarkAllotmentService->findBy([
            'training_course_id' => $trainingCourse->id
        ]);
    }

    public function getDateRange($training, $course = null)
    {
        if ($course) {
            return [
                Carbon::parse($course->start_date)->format('m/d/Y'),
                Carbon::parse($course->end_date)->format('m/d/Y'),
            ];
        } else {
            return [
                Carbon::parse($training->start_date)->format('m/d/Y'),
                Carbon::parse($training->end_date)->format('m/d/Y'),
            ];
        }
    }

    /**
     * @param Training $training
     * @param TrainingVenue $trainingVenue
     * @return Model
     */
    // public function createCourseFromTraining(Training $training, TrainingVenue $trainingVenue)
    // {
    //     $courseArrayData = $this->createCourseArray($training, $trainingVenue);
    //     return $this->save($courseArrayData);
    // }

    //---------------------------------------------------------------------------------------------------
    //                                   Private Function
    //---------------------------------------------------------------------------------------------------

    // private function createCourseArray(Training $training, TrainingVenue $trainingVenue)
    // {
    //     return [
    //         'training_id' => $training->id,
    //         'venue_id' => $trainingVenue->id,
    //         'name' => $training->title ?? trans('labels.not_found'),
    //         'name_bn' => $training->title ?? trans('labels.not_found'),
    //         'uid' => $training->uid,
    //         'start_date' => $training->start_date,
    //         'end_date' => $training->end_date,
    //     ];
    // }

    /**
     * @param array $data
     * @return array
     */
    private function formatRequestDates(array $data): array
    {
        $dateFormat = 'd/m/Y';
        $data['start_date'] = Carbon::createFromFormat($dateFormat, $data['start_date']);
        $data['end_date'] = Carbon::createFromFormat($dateFormat, $data['end_date']);
        return $data;
    }

    public function getOfflineCourse($trainingIds){
        return $courses = TrainingCourse::whereIn('training_id', $trainingIds)->get();
    }
    public function getOnlineCourse($trainingIds){
        return $courses = TrainingCourse::whereIn('training_id', $trainingIds)->get();
    }

    public function trainingCourseGrade(TrainingCourse $course)
    {
        return $this->trainingCourseGradeService->findBy([
            'training_course_id' => $course->id
        ]);
    }


}
