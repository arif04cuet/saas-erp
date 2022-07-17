<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\MMS\Services\MedicineService;
use Modules\MMS\Http\Requests\MedicineDistributionRequest;
use Illuminate\Http\Request;
use Modules\MMS\Services\MedicineInventoryService;
use Modules\MMS\Services\MedicineDistributionService;
use Validator;
use Modules\MMS\Services\PatientService;
use App\Http\Requests;


class MedicineDistributionController extends Controller
{

    /**
     * @var $medicineService
     */
    private $medicineService;
    /**
     * @var $medicineInventoryService
     */
    private $medicineInventoryService;
    /**
     * @var $medicineDistributionService
     */
    private $medicineDistributionService;
    /**
     * @var $patientService
     */
    private $patientService;

    /**
     * @param MedicineService $medicineService
     * @param MedicineInventoryService $medicineInventoryService
     * @param MedicineDistributionService $medicineDistributionService
     * @param PatientService $patientService
     *
     */

    public function __construct(
        MedicineService $medicineService,
        MedicineInventoryService $medicineInventoryService,
        PatientService $patientService,
        MedicineDistributionService $medicineDistributionService
    )
    {
        $this->medicineService = $medicineService;
        $this->patientService = $patientService;
        $this->medicineInventoryService = $medicineInventoryService;
        $this->medicineDistributionService = $medicineDistributionService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $medicinelist = $this->medicineDistributionService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);

        $result = array();
        foreach ($medicinelist as $key => $value) {
            $result[$key]['id'] = $value->id;
            $result[$key]['acknowledgement_slip'] = $value->acknowledgement_slip;
            $result[$key]['status'] = $value->status;
            $result[$key]['patient_id'] = $value->patient->patient_id;
            $result[$key]['patient_name'] = $value->patient->name;
            $result[$key]['date'] = date('d-M-Y', strtotime($value->date));
            $result[$key]['prescribed_date'] = (!empty($value->getPrescribedDate['date'])) ? date('d-M-Y', strtotime($value->getPrescribedDate['date'])) : null;
            $result[$key]['prescription_id'] = ($value->prescription_id !== 0) ? $value->prescription_id : null;
            $medicineInfo = array();
            foreach ($value->history as $info) {
                $medicineName = $this->medicineService->findOne($info->medicine_id)->name;
                $medicineInfo[] = $medicineName;
            }
            $result[$key]['patient_medicine'] = implode(", ", $medicineInfo); //explode('|',$medicineInfo);
        }
        $page = 'index';
        return view('mms::inventories.prescribed.index', compact('page', 'result'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->has('id')) {
            $prescriptionId = $request->input('id');
        } else {
            $prescriptionId = null;
        }
        $page = "create";
        $patient = $this->medicineDistributionService->getPatientForDropdown(null, null, null, true);
        $medicine = $this->medicineService->getMedicineForDropdown(null, null, null, true);
        return view('mms::inventories.prescribed.create', compact('page', 'medicine', 'patient', 'prescriptionId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param MedicineDistributionRequest $request
     * @return Response
     */
    public function store(MedicineDistributionRequest $request)
    {

        $data = $request->all();
        if (!isset($data['medicine'])) {
            return redirect()->route('inventories.prescribed.index')->with('warning', __('mms::medicine_distribution.medicine_add_alert'));
        }
        try {
            if ($this->medicineDistributionService->store($data)) {
                return redirect()->route('inventories.prescribed.index')->with('success', __('labels.save_success'));
            } else {
                return redirect()->route('inventories.prescribed.index')->with('warning', __('labels.save_fail'));
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return redirect()->route('inventories.prescribed.index')->with('warning', __('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $medicinelist = $this->medicineDistributionService->show($id);
        $page = 'Show';
        return view('mms::inventories.prescribed.show', compact('page', 'medicinelist'));
    }

    public function getInventoryMedicineQuantity(Request $request)
    {
        $medicineId = $request['medicineId'];
        $medicineInfo = $this->medicineInventoryService->findBy(['medicine_id' => $medicineId])->first();
        if (!empty($medicineInfo)):
            return $medicineInfo->quantity;
        else:
            return 0;
        endif;
    }

    /**
     * @param Request $request
     */
    public function acknowledgement(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072'
        ]);
        if ($validation->passes()) {
            $image_name = $this->medicineDistributionService->acknowledgementFiles($data);
            if ($image_name == true) {
                return redirect()->route('inventories.prescribed.index')->with('success', __('labels.update_success'));
            } else {
                return redirect()->route('inventories.prescribed.index')->with('warning', __('labels.save_fail'));
            }
        } else {
            return redirect()->route('inventories.prescribed.index')->with('warning', __('labels.save_fail'));

        }

    }

}
