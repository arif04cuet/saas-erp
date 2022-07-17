<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\MMS\Services\MedicineService;
use Modules\MMS\Services\MedicineRequisitionService;
use Modules\MMS\Http\Requests\MedicineRequisitionRequest;

class MedicineRequisitionController extends Controller
{
    /**
     * @var $medicineService
     */
    private $medicineService;
    /**
     * @var $medicineRequisitionService
     */
    private $medicineRequisitionService;


    /**
     * @param MedicineService $medicineService
     * @param MedicineRequisitionService $medicineRequisitionService
     */
    public function __construct(
        MedicineService $medicineService,
        MedicineRequisitionService $medicineRequisitionService
    )
    {
        $this->medicineService = $medicineService;
        $this->medicineRequisitionService = $medicineRequisitionService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $medicinelist = $this->medicineRequisitionService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);

        $result = array();
        foreach ($medicinelist as $key => $value) {
            $result[$key]['id'] = $value->id;
            $result[$key]['requisition_id'] = $value->requisition_id;
            $result[$key]['status'] = $value->status;
            $result[$key]['date'] = $value->date;
            $medicineInfo = array();
            foreach ($value->details as $info) {

                $medicineName = $this->medicineService->findOne($info->medicine_id)->name;
                array_push($medicineInfo, $medicineName);
            }
            $result[$key]['requisition_medicine'] = implode(",", $medicineInfo); //explode('|',$medicineInfo);
        }
        $page = 'index';
        return view('mms::requisition.index', compact('page', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        $medicine = $this->medicineService->getMedicineForDropdown(null, null, null, true);
        $nextSerialNumber = $this->medicineRequisitionService->getNextSerialNumber();
        return view('mms::requisition.create', compact('page', 'medicine', 'nextSerialNumber'));

    }

    /**
     * Store a newly created resource in storage.
     * @param MedicineRequisitionRequest $request
     * @return Response
     */
    public function store(MedicineRequisitionRequest $request)
    {
        $data = $request->all();
        if (!isset($data['medicine'])) {
            return redirect()->route('requisition.index')->with('warning', __('mms::medicine_distribution.medicine_add_alert'));
        }
        try {
            $store = $this->medicineRequisitionService->store($data);

            if ($store == true) {
                return redirect()->route('requisition.index')->with('success', __('labels.save_success'));
            } else {
                return redirect()->route('requisition.index')->with('warning', __('labels.save_fail'));
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return redirect()->route('requisition.index')->with('warning', __('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $medicinelist = $this->medicineRequisitionService->show($id);
        $page = 'Show';
        return view('mms::requisition.show', compact('page', 'medicinelist'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $page = 'edit';
        $medicine_info = $this->medicineRequisitionService->findOrFail($id);
        $medicine = $this->medicineService->getMedicineForDropdown(null, null, null, true);
        return view('mms::requisition.edit', compact('page', 'medicine', 'medicine_info'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;
        try {
            $delete = $this->medicineRequisitionService->requisitionUpdate($data);
            if ($delete == true) {
                return redirect()->route('requisition.index')->with('success', __('labels.update_success'));
            } else {
                return redirect()->route('requisition.index')->with('warning', __('labels.update_fail'));
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return redirect()->route('requisition.index')->with('warning', __('labels.save_fail'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $delete = $this->medicineRequisitionService->deleteMedicineRequisitionDetails($id);
        if ($delete == true) {
            return 100;
        } else {
            return 400;
        }
    }


}
