<?php

namespace Modules\TMS\Http\Controllers;

use App;
use Exception;
use Illuminate\Http\Request;
use Modules\TMS\Entities\Trainee;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingsService;
use App\Mail\TrainingRegistrationRejectMail;
use App\Mail\TrainingRegistrationApproveMail;
use Modules\TMS\Http\Requests\TraineeRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\TMS\Http\Requests\UpdateTraineeRequest;
use Modules\TMS\Services\TrainingCategoryService;

class TraineeController extends Controller
{
    private $traineeService, $trainingService, $categoryService;

    public function __construct(TraineeService $traineeService, TrainingsService $trainingService, TrainingCategoryService $categoryService)
    {
        $this->traineeService = $traineeService;
        $this->trainingService = $trainingService;
        $this->categoryService = $categoryService;
    }

    public function index($trainingId = null)
    {
        // $this->authorize('view', Trainee::class);
        $trainees = $trainingId ? $trainees = $this->traineeService->fetchTraineesWithID($trainingId) : null;
        $trainings = $this->trainingService->trainings();
        $selectedTrainingId = $trainingId;

        try {
            $training = Training::find($trainingId);
        } catch (Exception $exception) {
            $training = new Training();
        }

        return view('tms::trainee.index', compact('trainees', 'trainings', 'selectedTrainingId', 'training'));
    }

    public function create(Training $training)
    {
        $traineeCount = $this->traineeService->getTraineeCount($training->id);
        $langPreference = $training->lang_preference ?? Training::getLangPreferences()['both'];
        $langOptions = Training::getLangPreferences();

        return view('tms::trainee.create', compact('training', 'traineeCount', 'langPreference', 'langOptions'));
    }

    public function import(Request $request, $trainingId)
    {
        // $this->authorize('create', Trainee::class);
        $training = $this->trainingService->findOrFail($trainingId);
        $training->totel_registered_trainee = $this->trainingService->getTotelRegistaredTrainee($training);

        $numberOFTrainee = $training->no_of_trainee - $training->totel_registered_trainee;
        $localizedNumber = '';

        foreach (str_split($numberOFTrainee) as $key => $number) {
            $localizedNumber .= trans('tms::training.number.' . $number . '');
        }
        $message = trans('tms::training.fileUploadMassage');

        if (!App::isLocale('bn')) {
            $numberOfTraineeCanBeInFile = $message . ' ' . $localizedNumber;
        } else {
            $numberOfTraineeCanBeInFile = $localizedNumber . ' ' . $message;
        }

        $traineeCount = $this->traineeService->getTraineeCount($trainingId);

        $file_mimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/wps-office.xlsx'
        );
        $traineeList = array();
        $traineeListErrors = array();
        $is_overFlow = null;
        $isFormat = null;


        if ($request->hasFile(['import_file']) && in_array($_FILES['import_file']['type'], $file_mimes)) {
            $traineeList = $this->traineeService->importCSV($request);

            $headerFormat = [
                'First Name (character)',
                'Last name (character)',
                'Gender(Male/Female)',
                'Mobile (e.g: 01711111111)',
                'bangla_full_name',
                'english_full_name',
                '(e.g: Y/M/D)dob',
                'email',
                'badge_name',
                'badge_name_bn'
            ];

            $isFormat = (array_diff($headerFormat, $traineeList[0])) ? true : false;

            unset($traineeList[0]);
            $is_overFlow = null;
            if ($numberOFTrainee != 0) {
                if (!App::isLocale('bn')) {
                    $is_overFlow = count($traineeList) > $numberOFTrainee ? 'Extra entries in the file,reduce the entries to ' . $localizedNumber . ' and re-upload' : null;
                } else {
                    $is_overFlow = count($traineeList) > $numberOFTrainee ? 'ফাইলটিতে অতিরিক্ত এন্ট্রি আছে, এন্ট্রিগুলি ' . $localizedNumber . ' এ কমিয়ে দিন এবং পুনরায় আপলোড করুন' : null;
                }
            } else {
                $traineeListErrors = $this->traineeService->validateTraineeList($trainingId, $traineeList);
            }
        }


        return view(
            'tms::trainee.import',
            compact(
                'training',
                'trainingId',
                'traineeList',
                'traineeListErrors',
                'traineeCount',
                'numberOfTraineeCanBeInFile',
                'is_overFlow',
                'isFormat'
            )
        );
    }

    public function store(TraineeRequest $request, Training $training)
    {
        $trainee = $this->traineeService->storeTrainee($training, $request->all());
        if ($trainee) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainee.show', $trainee);
    }

    /**
     * This should be in a service
     * Added Try Catch
     * What a cocky code :/
     * @param Request $request
     * @param $training_id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function storeImported(Request $request, $training_id)
    {
        // $this->authorize('create', Trainee::class);
        $trainee_mobiles = $request->input('mobile');
        try {
            DB::beginTransaction();
            foreach ($trainee_mobiles as $key => $trainee_mobile) {
                $data = array(
                    'training_id' => $training_id,
                    'trainee_first_name' => $request->input('trainee_first_name')[$key],
                    'trainee_last_name' => $request->input('trainee_last_name')[$key],
                    'trainee_gender' => $request->input('trainee_gender')[$key],
                    'mobile' => $request->input('mobile')[$key],
                    'status' => 1,

                    'english_name' => $request->input('english_full_name')[$key],
                    'bangla_name' => $request->input('bangle_full_name')[$key],
                    'email' => $request->input('email')[$key],
                    'dob' => $request->input('dob')[$key],
                    'badge_name' => $request->input('badge_name')[$key],
                    'badge_name_bn' => $request->input('badge_name_bn')[$key],
                    'photo' => 'registered-trainees/default-profile-picture.png'
                );
                $storeData = $this->traineeService->save($data);
            }
            Session::flash('message', trans('labels.save_success'));
            DB::commit();
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Trainee Import Error: ' . $exception->getMessage() . " Trace: " . $exception->getTraceAsString());
            Session::flash('error', trans('labels.generic_error_message'));
            return redirect()->back();
        }
    }

    public function show(Trainee $trainee)
    {
        return view('tms::trainee.show', compact('trainee'));
    }

    public function edit(Trainee $trainee)
    {
        $langPreference = optional($trainee)->training->lang_preference ?? Training::getLangPreferences()['both'];
        $langOptions = Training::getLangPreferences();
        return view('tms::trainee.edit.personal_info', compact('trainee', 'langPreference', 'langOptions'));
    }

    public function update(UpdateTraineeRequest $request, Trainee $trainee)
    {
        $trainee = $this->traineeService->updateTrainee($trainee, $request->all());
        if ($trainee) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('trainee.show', $trainee);
    }

    public function destroy($id)
    {

        // $this->authorize('delete', Trainee::class);
        $response = $this->traineeService->delete($id);
        if ($response) {
            $msg = __('labels.delete_success');
        } else {
            $msg = __('labels.delete_fail');
        }
        Session::flash('message', $msg);

        return back();
    }

    public function print(Trainee $trainee)
    {
        $training = $trainee->training;
        return view('tms::trainee.print.print', compact('trainee', 'training'));
    }

    public function onlineEnrollTraineeList()
    {
        $trainees = $this->traineeService->fetchTraineesID();
        $trainings = $this->trainingService->trainings(false)
            ->flatten()
            ->map(function ($training) {
                if (app()->isLocale('bn')) {
                    return $training->bangla_title;
                }
                return $training->title;
            });

        return view('tms::trainee.online-trainee', compact('trainees', 'trainings'));
    }

    public function onlineEnrolledTraineeApprove(Trainee $trainee)
    {
        $trainee = $this->traineeService->approveOnlineEnrollTrainee($trainee);
        if ($trainee) {
            if (!empty($trainee->email)) {
                try {
                    Mail::to($trainee->email)->send(new TrainingRegistrationApproveMail($trainee));
                } catch (\Exception $exception) {
                    Log::error("Modules: TMS -> " . get_class($this) . " : {$exception->getMessage()}\n{$exception->getTraceAsString()}");
                }
            }
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('online.enroll.trainee.list');
    }
    public function onlineEnrolledTraineeReject(Trainee $trainee)
    {
        $trainee = $this->traineeService->rejectOnlineEnrollTrainee($trainee);
        if ($trainee) {
            if (!empty($trainee->email)) {
                try {
                    Mail::to($trainee->email)->send(new TrainingRegistrationRejectMail($trainee));
                } catch (\Exception $exception) {
                    Log::error("Modules: TMS -> " . get_class($this) . " : {$exception->getMessage()}\n{$exception->getTraceAsString()}");
                }
            }
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('online.enroll.trainee.list');
    }
}
