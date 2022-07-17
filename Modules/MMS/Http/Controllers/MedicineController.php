<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\MMS\Http\Requests\MedicineRequest;
use Modules\MMS\Services\MedicineService;
use Modules\MMS\Services\MedicineGroupService;
use Modules\MMS\Services\MedicineCompanyService;
use Modules\MMS\Entities\Medicine;
use Session;
use Modules\MMS\Services\MedicineInventoryService;
use Modules\IMS\Services\InventoryItemCategoryService;


class MedicineController extends Controller
{
    /**
     * @var $medicineService
     */
    private $medicineService;
    /**
     * @var $medicineGroupService
     */
    private $medicineGroupService;
    /**
     * @var $medicineCompanyService
     */
    private $medicineCompanyService;

    /**
     * @var $medicineInventoryService
     */
    private $medicineInventoryService;

    /**
     * @var InventoryItemCategoryService
     */
    private $inventoryItemCategoryService;

    /**
     * @param MedicineService $medicineService
     * @param MedicineGroupService $medicineGroupService
     * @param MedicineCompanyService $medicineCompanyService
     * @param MedicineInventoryService $medicineInventoryService
     */

    public function __construct(
        MedicineService $medicineService,
        MedicineGroupService $medicineGroupService,
        MedicineCompanyService $medicineCompanyService,
        MedicineInventoryService $medicineInventoryService,
        InventoryItemCategoryService $inventoryItemCategoryService

    )
    {
        $this->medicineService = $medicineService;
        $this->medicineGroupService = $medicineGroupService;
        $this->medicineCompanyService = $medicineCompanyService;
        $this->medicineInventoryService = $medicineInventoryService;
        $this->inventoryItemCategoryService = $inventoryItemCategoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $medicinelist = $this->medicineService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);
        return view('mms::medicine.index', compact('medicinelist'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        $medicine_group = $this->medicineGroupService->getMedicineGroupForDropdown(null, null, null, true);
        $medicine_company = $this->medicineCompanyService->getCompanyForDropdown(null, null, null, true);
        $inventory_categories = $this->inventoryItemCategoryService->getItemCategoryForDropdown(null, null, null, true);
        return view('mms::medicine.create', compact('page', 'medicine_group', 'medicine_company', 'inventory_categories'));
    }

    /**
     * @param MedicineRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MedicineRequest $request)
    {
        if ($this->medicineService->store($request->all())) {
            return redirect()->route('medicine.index')->with('success', __('labels.save_success'));
        }
        return redirect()->back()->with('error', __('labels.save_fail'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function show($id)
    {
        $medicine = $this->medicineService->findOne($id);
        return view('mms::medicine.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $medicine = $this->medicineService->findBy(['id' => $id])->first();
        $medicine_group = $this->medicineGroupService->getMedicineGroupForDropdown(null, null, null, true);
        $medicine_company = $this->medicineCompanyService->getCompanyForDropdown(null, null, null, true);
        $page = "edit";

        $inventory_categories = $this->inventoryItemCategoryService->getItemCategoryForDropdown(null, null, null, true);
        return view('mms::medicine.create', compact('medicine', 'page', 'medicine_group', 'medicine_company', 'inventory_categories'));
    }

    /**
     * @param MedicineRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MedicineRequest $request, $id)
    {
        if ($this->medicineService->medicineUpdate($request->all(), $id)) {
            return redirect()->route('medicine.index')->with('success', __('labels.update_success'));
        }
        return redirect()->back()->with('error', __('labels.update_fail'));

        // return redirect()->route('medicine.index')->with('success', __('labels.update_success'));
    }

    /**
     * @param Medicine $medicine
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Medicine $medicine, $id)
    {
        $checkMedicineAllReadyUse = $this->medicineInventoryService->findBy(['medicine_id' => $id])->count();
        if ($checkMedicineAllReadyUse < 1) {
            $medicine->destroy($id);
            return redirect()->route('medicine.index')->with('warning', __('labels.delete_success'));
        } else {
            return redirect()->route('medicine.index')->with('warning', trans('mms::medicine.already_in_use'));
        }
    }


}

