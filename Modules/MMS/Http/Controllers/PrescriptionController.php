<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\EmployeeService;
use Modules\MMS\Services\MedicineService;
use Modules\MMS\Http\Requests\PrescriptionRequest;
use Modules\MMS\Services\PatientService;
use Modules\MMS\Services\PrescriptionService;
use Illuminate\Support\Facades\Auth;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Services\TraineeService;
use Modules\MMS\Entities\Prescription;

class PrescriptionController extends Controller
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
     * @var PrescriptionService
     */
    private $prescriptionService;

    /**
     * @var $medicineService
     */
    private $medicineService;

    /**
     * @var TrainingsService
     */
    private $trainingService;

    /**
     * @var TraineeService
     */
    private $traineeService;

    /**
     * PrescriptionController constructor.
     * @param EmployeeService $employeeService
     * @param MedicineService $medicineService
     * @param PatientService $patientService
     * @param PrescriptionService $prescriptionService
     * @param TrainingsService $trainingService
     * @param TraineeService $traineeService
     */
    public function __construct(
        EmployeeService $employeeService,
        MedicineService $medicineService,
        PatientService $patientService,
        PrescriptionService $prescriptionService,
        TrainingsService $trainingService,
        TraineeService $traineeService
    )
    {
        $this->employeeService = $employeeService;
        $this->medicineService = $medicineService;
        $this->patientService = $patientService;
        $this->trainingService = $trainingService;
        $this->traineeService = $traineeService;
        $this->prescriptionService = $prescriptionService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $prescriptions =Prescription::groupBy('name')->orderBy('created_at', 'desc')->get();
        $page = 'index';
        return view('mms::prescription.index', compact('prescriptions', 'page'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if (!Auth::user()->hasRole(['ROLE_DOCTOR'])) {
            return redirect()->route('prescriptions.index')->with('warning', 'Sorry ! You have no access permission');
        }
        if ($request->has('id')) {
            $patientId = $request->input('id');
        } else {
            $patientId = null;
        }
//        $employees2 = $this->patientService->getEmployeesForDropdown(null, null, null, true);
//        $employees = $this->employeeService->getEmployeesForDropdown(null, null, null, true);
        $page = "create";
        $medicine = $this->medicineService->getMedicineForDropdown(null, null, null, true);
//        $trainings = [];
//        $trainees = [];
        $patient = $this->patientService->getPatientForDropdown();
        return view('mms::prescription.create', compact('page','medicine','patient','patientId'));
//        return view('mms::prescription.create', compact('employees', 'medicine', 'page', 'employees2', 'trainings', 'trainees', 'patient','patientId'));


    }

    /**
     * Store a newly created resource in storage.
     * @param PrescriptionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrescriptionRequest $request)
    {
        $inputData = $request->all();
        $checkPatient = $this->patientService->findBy(['patient_id' => $inputData['patient_id']])->first();
        if (!empty($checkPatient)) {
            $inputData['patient_id'] = $checkPatient->patient_id;
            $inputData['name'] = $checkPatient->name;
            $inputData['age'] = $checkPatient->age;
            $inputData['mobile_no'] = $checkPatient->mobile_no;
            $inputData['gender'] = $checkPatient->gender;
            $inputData['relation'] = $checkPatient->relation;
            $inputData['type'] = $checkPatient->type;
        } else {
            return redirect()->route('prescriptions.index')->with('warning', __('labels.No_matching_records_found'));
//            $inputData['employee_id'] = $inputData['employee'];
//            $patient = $this->patientService->save($inputData);
//            $inputData['patient_id'] = $patient->patient_id;
        }
        $saveData = $this->prescriptionService->store($inputData);
        if ($saveData == true) {
            return redirect()->route('prescriptions.index')->with('success', __('labels.save_success'));
        } else {
            return redirect()->route('prescriptions.index')->with('warning', __('labels.save_fail'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function show($id)
    {
        $page = "show";
        $prescription = $this->prescriptionService->findOne($id);
        $medicine = $this->prescriptionService->medicineDetails($id);
        $test = $this->prescriptionService->medicineTestDetails($id);
        $allOeReport = $this->prescriptionService->medicineOE($id);

        return view('mms::prescription.show', compact('prescription', 'page', 'medicine', 'test', 'allOeReport'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function edit($id)
    {
        $employees = $this->employeeService->getEmployeesForDropdown(null, null, null, true);
        $employees2 = $this->patientService->getEmployeesForDropdown(null, null, null, true);
        $page = "edit";
        $prescription = $this->prescriptionService->findOne($id);
        $employeeID = explode("-", $prescription['patient_id']);
        $employee = $this->employeeService->findBy(['employee_id' => $employeeID[0]])->first();
        $medicines = $this->medicineService->getMedicineForDropdown(null, null, null, true);
        $medicine = $this->prescriptionService->medicineDetails($id);
        $medicineOe = $this->prescriptionService->medicineOE($id);
        $test = $this->prescriptionService->medicineTestDetails($id);
        $trainings = $this->trainingService->getTrainingsForDropdown();;
        $trainees = [];
        $patient = $this->patientService->getPatientForDropdown();
        return view('mms::prescription.edit', compact('prescription', 'page', 'medicine', 'medicines', 'test', 'employees', 'employee', 'employees2', 'medicineOe', 'trainings', 'trainees','patient'));
    }

    /**
     * @param PrescriptionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrescriptionRequest $request, $id)
    {
        $inputData = $request->all();
        $inputData['id'] = $id;
        $checkPatient = $this->patientService->findBy(['patient_id' => $inputData['patient_id']])->first();
        if (!empty($checkPatient)) {
            $inputData['patient_id'] = $checkPatient->patient_id;
        } else {
//            $inputData['employee_id'] = $inputData['employee'];
//            $patient = $this->patientService->save($inputData);
//            $inputData['patient_id'] = $patient->patient_id;
            return redirect()->route('prescriptions.index')->with('warning', __('labels.update_fail'));
        }
        $saveData = $this->prescriptionService->update($inputData);
        if ($saveData == true) {
            return redirect()->route('prescriptions.index')->with('success', __('labels.update_success'));
        } else {
            return redirect()->route('prescriptions.index')->with('warning', __('labels.update_fail'));
        }

    }

    /**
     * @param Request $request
     * @return int
     */
    public function medicineDelete(Request $request)
    {
        $id = $request->input('id');
        $delete = $this->prescriptionService->deletePrescriptionMedicine($id);
        if ($delete == true) {
            return 100;
        } else {
            return 400;
        }
    }

    /**
     * @param Request $request
     * @return int
     */
    public function testDelete(Request $request)
    {
        $id = $request->input('id');
        $delete = $this->prescriptionService->deletePrescriptionTest($id);
        if ($delete == true) {
            return 100;
        } else {
            return 400;
        }
    }

    public function prescriptionListByPatient($patient_id=null){
        $prescriptions = $this->prescriptionService->findBy(['patient_id'=>$patient_id], null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);

        $page = 'list';
        return view('mms::prescription.prescription_list_by_patient', compact('prescriptions', 'page'));

    }
}
