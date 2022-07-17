<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\MMS\Services\PatientService;
use Modules\HRM\Services\EmployeeService;
use Modules\MMS\Http\Requests\PatientRequest;
use Modules\MMS\Entities\Patient;
use Modules\MMS\Services\MedicineDistributionService;
use Session;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Services\TraineeService;

class PatientController extends Controller
{
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var PatientService
     */
    private $patientService;

    /**
     * @var $medicineDistributionService
     */
    private $medicineDistributionService;

    /**
     * @var TrainingsService
     */
    private $trainingService;
    /**
     * @var TraineeService
     */
    private $traineeService;

    /**
     * PatientController constructor.
     * @param EmployeeService $employeeService
     * @param PatientService $patientService
     * @param TrainingsService $trainingService
     * @param TraineeService $traineeService
     * @param MedicineDistributionService $medicineDistributionService
     */
    public function __construct(
        EmployeeService $employeeService,
        PatientService $patientService,
        TrainingsService $trainingService,
        TraineeService $traineeService,
        MedicineDistributionService $medicineDistributionService
    )
    {
        $this->employeeService = $employeeService;
        $this->patientService = $patientService;
        $this->trainingService = $trainingService;
        $this->traineeService = $traineeService;
        $this->medicineDistributionService = $medicineDistributionService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $patients = $this->patientService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);

        return view('mms::patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $employees = $this->patientService->getEmployeesForDropdown(null, null, null, true);
        $page = "create";
        $trainings = [];
        $trainees = [];
        return view('mms::patient.create', compact('employees', 'page', 'trainings', 'trainees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PatientRequest $request)
    {
        $inpuData = $request->all();
        if ($request->input('type') == 'trainee') {
            $inpuData['employee_id'] = null;
        }
        $this->patientService->store($inpuData);

        return redirect()->route('patients.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $patient = $this->patientService->findOne($id);
        return view('mms::patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $patient = $this->patientService->findOrFail($id);
        if ($patient->type == 'employee') {
            $patient_id = ['employee_id' => $patient->patient_id];
        } else {
            $patient_id = ['id' => $patient->employee_id];
        }
        $employees = $this->patientService->getEmployeesForDropdown(null, null, null, true);
        $employee = $this->employeeService->findBy($patient_id)->first();
        $page = "edit";
        $trainings = $this->trainingService->getTrainingsForDropdown();;
        $trainees = [];
        return view('mms::patient.create', compact('patient', 'employees', 'employee', 'page', 'trainings', 'trainees'));
    }

    /**
     * @param PatientRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PatientRequest $request, $id)
    {
        $inpuData = $request->all();
        if ($request->input('type') == 'trainee') {
            $inpuData['employee_id'] = null;
        }
        $this->patientService->findOrFail($id)->update($inpuData);

        return redirect()->route('patients.index')->with('success', __('labels.update_success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployeeController(Request $request)
    {
        $details = $this->employeeService->findOne($request->id);
        return response()->json($details);
    }

    /**
     * Remove the specified resource from storage.
     * @param $patient
     * @param $id
     * @return Response
     */
    public function destroy(Patient $patient, $id)
    {
        $findPatientData = $patient->find($id);
        $patientId = $findPatientData->patient_id;
        $checkMedicineAllReadyUse = $this->medicineDistributionService->findBy(['patient_id' => $patientId])->count();
        if ($checkMedicineAllReadyUse < 1) {
            $patient->destroy($id);
            return redirect()->route('patients.index')->with('warning', __('labels.delete_success'));

        } else {
            return redirect()->back()->with('error', trans('mms::patient.already_use'));
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function relative(Request $request)
    {
        $data = $request->all();
        $emId = $data['id'];

        return $medicine_company = $this->patientService->getRelativeForDropdown(null, null, ['employee_id' => $emId],
            true);

    }

    /**
     * get active Traini list
     *
     * @return void
     */
    public function getTrainingsList()
    {
        return $traineeList = $this->trainingService->getActiveTrainings();
    }

    /**
     * @param int $trainingId
     * @return array
     */
    public function getTraineeByTrainingsId($trainingId = 1)
    {
        $traineesList = $this->traineeService->fetchTraineesWithID($trainingId);
        return $trainees = $this->traineeService->getTraineesForDropdown($traineesList);

    }

    /**
     * This methor use for get trainee list
     * @param Request $request
     * @return array
     */
    public function fetchTraineesWithID(Request $request)
    {
        $ID = $request->input('id');
        $trainee = $this->traineeService->getTraineeInformation($ID);
        $lang = app()->getLocale();
        $name = $lang == 'bn' ? $trainee->bangla_name : $trainee->english_name;
        $patientId = 'TR' . $trainee->training_id . 'TE' . $trainee->id;
        $result = [
            'name' => $name,
            'mobile' => $trainee->mobile,
            'gender' => $trainee->trainee_gender,
            'patient_id' => $patientId
        ];
        return $result;
    }


}
