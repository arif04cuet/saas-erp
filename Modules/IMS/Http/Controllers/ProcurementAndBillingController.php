<?php

namespace Modules\IMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\IMS\Http\Requests\ProcurementBillingRequest;
use Modules\IMS\Services\InventoryLocationService;
use Modules\IMS\Services\ProcurementAndBillingService;
use Modules\IMS\Services\ProcurementAndBillSettingService;
use Modules\IMS\Services\VendorService;

class ProcurementAndBillingController extends Controller
{
    /**
     * @var ProcurementAndBillingService
     */
    private $procurementAndBillingService;
    /**
     * @var VendorService
     */
    private $vendorService;
    /**
     * @var InventoryLocationService
     */
    private $inventoryLocationService;
    /**
     * @var ProcurementAndBillSettingService
     */
    private $billSettingService;

    /**
     * ProcurementAndBillingController constructor.
     * @param ProcurementAndBillingService $procurementAndBillingService
     * @param VendorService $vendorService
     * @param InventoryLocationService $inventoryLocationService
     * @param ProcurementAndBillSettingService $billSettingService
     */
    public function __construct(
        ProcurementAndBillingService $procurementAndBillingService,
        VendorService $vendorService,
        InventoryLocationService $inventoryLocationService,
        ProcurementAndBillSettingService $billSettingService
    ) {
        $this->procurementAndBillingService = $procurementAndBillingService;
        $this->vendorService = $vendorService;
        $this->inventoryLocationService = $inventoryLocationService;
        $this->billSettingService = $billSettingService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $procurements = $this->procurementAndBillingService->findAll(
            null,
            ['items'],
            ['column' => 'id', 'direction' => 'desc']
        );
        return view('ims::procurement-billing.index', compact('procurements'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $page = 'create';
        $vendors = ['' => __('labels.select')] + $this->vendorService->getDropdownOptions()->toArray();
        $locations = ['' => __('labels.select')] + $this->inventoryLocationService->getMainStoreLocation();
        $itemCategories = $this->procurementAndBillingService->getItemCategories();
        $settings = $this->billSettingService->getEmployeesForDropdown();
        $defaultSetting = $this->billSettingService->getDefaultSetting();

        return view('ims::procurement-billing.create', compact(
                'page',
                'vendors',
                'locations',
                'itemCategories',
                'settings',
                'defaultSetting'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProcurementBillingRequest $request)
    {
        if ($this->procurementAndBillingService->store($request->all())) {
            return redirect()->route('procurement-billings.index')
                ->with('success', __('labels.save_success'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $procurement = $this->procurementAndBillingService->findOne($id);
        return view('ims::procurement-billing.show', compact('procurement'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('ims::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
