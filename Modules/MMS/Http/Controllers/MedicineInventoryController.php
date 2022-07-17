<?php


namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\MMS\Http\Requests\MedicineInventoryRequest;
use Modules\MMS\Services\MedicineService;
use Modules\MMS\Services\MedicineInventoryService;
use Modules\MMS\Services\MedicineInventoryHistoryService;
use Modules\MMS\Entities\MedicineInventoryHistory;


class MedicineInventoryController extends Controller
{
    /**
     * @var $medicineService
     * @var $medicineInventoryService
     * @var $medicineInventoryHistoryService
     */
    private $medicineService;
    private $medicineInventoryService;
    private $medicineInventoryHistoryService;
    const IN = 'IN';


    /**
     * @param MedicineService $medicineService
     * @param MedicineInventoryService $medicineInventoryService ;
     * @param MedicineInventoryHistoryService $medicineInventoryHistoryService ;
     */

    public function __construct(MedicineService $medicineService, MedicineInventoryService $medicineInventoryService, MedicineInventoryHistoryService $medicineInventoryHistoryService)
    {
        $this->medicineService = $medicineService;
        $this->medicineInventoryService = $medicineInventoryService;
        $this->medicineInventoryHistoryService = $medicineInventoryHistoryService;

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $medicineList = $this->medicineInventoryService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);
        return view('mms::inventories.medicines.index', compact('medicineList'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        $medicine = $this->medicineService->getMedicineForDropdown(null, null, null, true);
        return view('mms::inventories.medicines.create', compact('page', 'medicine', 'page'));
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $medicineInfo = $this->medicineInventoryService->findOne($id);
        $inventoryHistory = $this->medicineInventoryHistoryService->findBy(['medicine_id' => $medicineInfo->medicine_id]);
        return view('mms::inventories.medicines..show', compact('medicineInfo', 'inventoryHistory'));
    }

    /**
     * Store a newly created resource in storage.
     * @param MedicineInventoryRequest $request
     * @return Response
     */
    public function store(MedicineInventoryRequest $request)
    {
        $data = $request->all();
        if ($this->medicineInventoryService->medicalInventoryStore($data)) {
            return redirect()->route('inventories.medicines.index')->with('success', __('labels.save_success'));
        }
        return redirect()->back()->with('error', __('labels.save_fail'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $medicine_info = $this->medicineInventoryService->findBy(['id' => $id])->first();
        $medicine = $this->medicineService->getMedicineForDropdown(null, null, null, true);
        $page = "edit";
        return view('mms::inventories.medicines.create', compact('medicine', 'page', 'medicine_info'));

    }

    /**
     * @param MedicineInventoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MedicineInventoryRequest $request, $id)
    {
        $data = $request->all();
        $saveData = $this->medicineInventoryService->findOrFail($id)->update($request->all());
        if ($saveData) {
            return redirect()->route('inventories.medicines.index')->with('success', __('labels.update_success'));

        } else {
            return redirect()->route('inventories.medicines.index')->with('warning', __('labels.update_fail'));

        }
    }
}
