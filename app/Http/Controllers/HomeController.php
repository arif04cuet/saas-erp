<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Services\RoleService;
use Modules\TMS\Entities\Trainee;
use Illuminate\Support\Collection;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Lang;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCategory;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Entities\TrainingCourseBatch;
use Modules\TMS\Services\TrainingCourseService;
use Modules\TMS\Entities\TrainingCourseResource;
use App\Services\Notification\AppNotificationService;

class HomeController extends Controller
{

    private $trainingService;
    private $courseService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TrainingsService $trainingService, TrainingCourseService $courseService)
    {
        $this->trainingService = $trainingService;
        $this->courseService = $courseService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allInstructor = TrainingCourseResource::all()->count();
        $offlineTrainingIds = $this->trainingService->getOfflineTrainings()->pluck('id');
        $allOfflinecourses = $this->courseService->getOfflineCourse($offlineTrainingIds)->count();
        $allOnlineTraining = $this->trainingService->getOnlineTrainings();
        $onlineTrainingIds = $this->trainingService->getOnlineTrainings()->pluck('id');
        $allOnlineCourse = $this->courseService->getOnlineCourse($onlineTrainingIds);
        $allCourseBatch = TrainingCourseBatch::all()->count();
        $trainingCategories = $this->trainingCategories();
        $instructors = $this->getInstructor();
        $allTrainee = Trainee::all()->count();
        $onlineTrainingIds = $this->trainingService->getOnlineTrainings()->pluck('id');
        $allOnlineCourse = $this->courseService->getOnlineCourse($onlineTrainingIds);

        return view('home', compact('allInstructor', 'allOnlineTraining', 'allOnlineCourse', 'allOfflinecourses', 'allCourseBatch', 'allTrainee', 'trainingCategories', 'instructors'));
    }

    public function offlineCourseListPublicView()
    {
        $trainingIds = $this->trainingService->getOfflineTrainings()->pluck('id');
        $courses = $this->courseService->getOfflineCourse($trainingIds);
        return view('tms::public.offline-course-public-view', compact('courses'));
    }

    public function trainingCategories()
    {
        return $trainingCategory = TrainingCategory::select('id', 'name_bangla')
            ->where('parent_id', 0)->get();
    }
    public static function categoryWiseTraining($category)
    {
        return $trainingCategory = Training::where('category_id', $category->id)->orderBy('id', 'desc')->get();
    }
    public function getInstructor()
    {
        return $instructor = TrainingCourseResource::where('reference_entity', Employee::class)->limit(5)->get();

        // $instructor_data  = $instructors->toArray();
        // $new_instructor_data = [];
        // $total_items = ceil((count($instructor_data)/5));

        // for($i=0; $i < $total_items; $i++){
        //     $new_instructor_data[$i] = [];
        // }
        // foreach ($instructor_data as $key => $row) 
        // {
        //     $slug = true;
        //     foreach ($new_instructor_data as $key2 => $value) {
        //         if(count($value) < 5 && $slug){
        //             $slug = false;
        //             $new_instructor_data[$key2][] = $row;
        //         }
        //     }
        // }
    }

    public function testFn()
    {
        $collectArr = [1, 2, 3, 4, 5, 8, 9];
        // $collectArr = [
        //     ['foo' => 10],
        //     ['bar' => 20],
        //     ['foo' => 20],
        //     ['foo' => 5],
        //     ['foo' => 30], 
        //     ['bar' => 20],
        //     ['bar' => 25]
        // ];
        // $collection = collect(str_split('AABBCCCD'));
        // return $chunks = $collection->chunkWhile(function($value, $key, $chunk){
        //     return $value === $chunk->last();
        // })->collapse();
        // $collect = ['name','age'];
        // dd(collect($collect)->combine(['araf','30']));
        // $collection = collect(['John Doe']);

        // $concatenated = $collection->concat(['Jane Doe'])->concat(['name' => ['Johnny Doe','Yasin']]);
        $result = collect([3, 4])->every(function ($value, $key) {
            // dd($value);
            return $value > 2;
        });

        dd($result);
        dd('hi');
    }
}
