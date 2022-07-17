<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\TMS\Entities\Trainee;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Http\Requests\TraineeRequest;
use Modules\TMS\Services\TraineeDiseaseService;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Services\RegisteredTraineeService;
use Modules\TMS\Http\Requests\StoreRegisteredTraineeRequest;
use Modules\TMS\Http\Requests\StorePublicTraineeRegistrationRequest;

class PublicTrainingRegistrationController extends Controller
{
    /**
     * @var TrainingsService
     */
    private $trainingService;
    /**
     * @var RegisteredTraineeService
     */
    private $registeredTraineeService;
    /**
     * @var TraineeDiseaseService
     */
    private $traineeDiseaseService;
    /**
     * @var TraineeService
     */
    private $traineeService;

    public function __construct(
        TrainingsService $trainingService,
        TraineeService $traineeService,
        RegisteredTraineeService $registeredTraineeService,
        TraineeDiseaseService $traineeDiseaseService
    ) {
        $this->trainingService = $trainingService;
        $this->traineeService = $traineeService;
        $this->registeredTraineeService = $registeredTraineeService;
        $this->traineeDiseaseService = $traineeDiseaseService;
    }

    public function index()
    {
        $instructors = $this->getInstructor();
        $trainings = $this->trainingService->getTrainings();
        // dd($trainings);
        return view('tms::public.training-registration.index', compact('trainings', 'instructors'));
    }
    public function courseDetail()
    {
        $instructors = $this->getInstructor();
        $trainings = $this->trainingService->getTrainings();
        return view('tms::public.training-registration.course-detail', compact('trainings', 'instructors'));
    }

    public function create(Training $training)
    {
        if (!Session::has('mobile') && !Session::has('success')) {
            return redirect()->route('trainings.trainees.registrations.check', ['training' => $training]);
        }
        $orderBy = array('column' => 'id', 'direction' => 'asc');
        $diseases = $this->traineeDiseaseService->findAll(null, null, $orderBy);
        $currentDate = Carbon::today();
        $deadline = Carbon::parse($training->registration_deadline);
        $registeredTraineeNo = count($training->trainee);
        $langPreference = $training->lang_preference ?? Training::getLangPreferences()['both'];
        $langOptions = Training::getLangPreferences();
        return view('tms::public.training-registration.create', compact(
            'training',
            'diseases',
            'currentDate',
            'deadline',
            'langPreference',
            'langOptions',
            'registeredTraineeNo'
        ));
    }

    public function store(StorePublicTraineeRegistrationRequest $request, Training $training)
    {
        $trainee = $this->registeredTraineeService->store($request->all());
        if ($trainee) {
            Session::flash('success', trans('labels.save_success'));
            Session::put('trainee', $trainee->bangla_name);
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('training-registration.create', $training);
    }

    public function unique(Request $request, Training $training, Trainee $trainee = null)
    {
        $doesTraineeExist = $this->checkTraineeExist($request, $trainee);

        return json_encode(['status' => $doesTraineeExist]);
    }

    public function check(Training $training)
    {
        return view(
            'tms::public.training-registration.check.create',
            compact(
                'training'
            )
        );
    }

    public function verify(StorePublicTraineeRegistrationRequest $request, Training $training)
    {
        $registeredTrainee = $this->traineeService->getRegisteredTraineeOfTraining(
            $request->mobile,
            $training
        )->first();
        if (!is_null($registeredTrainee)) {
            return redirect()->route(
                'trainings.trainees.registrations.show',
                ['training' => $training, 'trainee' => $registeredTrainee]
            );
        } else {
            Session::flash('warning', trans('tms::training.admit_message'));
            return redirect()->route(
                'training-registration.create',
                ['training' => $training]
            )->with(['mobile' => $request->input('mobile')]);
        }
    }

    public function show(Training $training, Trainee $trainee)
    {
        return view('tms::public.training-registration.show', compact('training', 'trainee'))
            ->with('success', trans('tms::trainee.registration.mobile.unique'));
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

    //---------------------------------------------------------------------------
    //                          Private methods
    //---------------------------------------------------------------------------
    private function checkTraineeExist($request, $trainee)
    {
        $existingTrainee = $this->registeredTraineeService
            ->findBy([
                'mobile' => $request->mobile,
                'training_id' => $request->training_id
            ])
            ->first();

        if (is_null($trainee)) {
            return is_null($existingTrainee) ? true : false;
        } else {
            return is_null($existingTrainee) ? true : $this->isCurrentTraineeMobile($trainee, $request->mobile);
        }
    }

    private function isCurrentTraineeMobile($trainee, $mobile)
    {
        return optional($trainee)->mobile == $mobile;
    }
}
