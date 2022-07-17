<?php

namespace Modules\IMS\Http\Controllers\Inventory;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\InventoryRequest;
use Modules\IMS\Constants\InventoryRequestType;
use Modules\IMS\Services\InventoryRequestService;
use Modules\IMS\Services\InventoryCategoryGroupService;
use Modules\IMS\Http\Requests\CreateInventoryRequestPostRequest;
use Modules\IMS\Http\Requests\InitialInventoryRequestPutRequest;
use Modules\IMS\Http\Requests\InitialInventoryRequestPostRequest;

class InventoryRequestController extends Controller
{
    private $inventoryRequestService;

    private $inventoryGroupService;

    protected const INITIAL_FORM = 'initial';
    protected const DETAIL_FORM = 'detail';

    public function __construct(
        InventoryRequestService $inventoryRequestService, 
        InventoryCategoryGroupService $inventoryGroupService
    ) {
        $this->inventoryGroupService = $inventoryGroupService;
        $this->inventoryRequestService = $inventoryRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $departmentCode = get_user_department()->department_code;
        $inventoryRequests = $this->inventoryRequestService->filterRequestByDepartment($departmentCode);
        return view('ims::inventory.request.index', compact('inventoryRequests', 'departmentCode'));
    }

    /**
     * Show the form for creating a new resource.
     * @param string $type
     * @return Response
     */
    public function initialForm(string $type)
    {
        $formType = self::INITIAL_FORM;

        list($employees, $fromLocations, $toLocations, $flags) = $this->inventoryRequestService->prepareInitialForm($type);

        return view('ims::inventory.request.create',
            compact('employees',
                'fromLocations',
                'toLocations',
                'formType',
                'flags',
                'type'
            )
        );
    }

    /**
     * Store initial info of Inventory Request in storage.
     * @param InitialInventoryRequestPostRequest $request
     * @param string $type
     * @return Response
     */
    public function storeInitial(InitialInventoryRequestPostRequest $request, string $type)
    {
        $inventoryRequest = $this->inventoryRequestService->storeInitial($request->all());
        if ($inventoryRequest) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return $request->give_detail
            ? redirect()->route('inventory-request.create.detail', [$type, $inventoryRequest->id])
            : redirect()->route('inventory-request.index');
    }

    /**
     * Show the form for editing a new resource.
     * @param string $type
     * @param InventoryRequest $inventoryRequest
     * @return void
     */
    public function initialEditForm(string $type, InventoryRequest $inventoryRequest)
    {
        $formType = self::INITIAL_FORM;

        return view('ims::inventory.request.edit',
            compact('inventoryRequest',
                'formType',
                'type'
            )
        );
    }

    /**
     * Update initial info of Inventory Request in storage.
     * @param InitialInventoryRequestPutRequest $request
     * @param string $type
     * @param InventoryRequest $inventoryRequest
     * @return Response
     */
    public function updateInitial(
        InitialInventoryRequestPutRequest $request,
        string $type,
        InventoryRequest $inventoryRequest
    ) {
        if ($this->inventoryRequestService->updateInitial($request->all(), $inventoryRequest)) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return $request->give_detail
            ? redirect()->route('inventory-request.create.detail', [$type, $inventoryRequest->id])
            : redirect()->route('inventory-request.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param string $type
     * @param InventoryRequest $inventoryRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailForm(string $type, InventoryRequest $inventoryRequest)
    {
        $formType = self::DETAIL_FORM;
        $type = $inventoryRequest->type;

        $formData = $this->inventoryRequestService->prepareDetailForm($type, $inventoryRequest);
        $language = 'name_' . Config::get('app.locale');
        $groups = $this->inventoryGroupService->findAll()->pluck($language, 'id');
        if ($type == InventoryRequestType::TRANSFER) {
            return $this->transferDetail($inventoryRequest, $formData);
        }
        list($bladesName, $categories, $data) = $formData;

        return view('ims::inventory.request.create',
            compact('inventoryRequest',
                'categories',
                'bladesName',
                'formType',
                'type',
                'data',
                'groups'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     * @param string $type
     * @param InventoryRequest $inventoryRequest
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function detailFormEdit(string $type, InventoryRequest $inventoryRequest)
    {
        $formType = self::DETAIL_FORM;
        $type = $inventoryRequest->type;
        $formData = $this->inventoryRequestService->prepareDetailForm($type, $inventoryRequest);
        if ($type == InventoryRequestType::TRANSFER) {
            return $this->transferDetail($inventoryRequest, $formData, 'edit');
        }

        list($bladesName, $categories, $data) = $formData;

        return view('ims::inventory.request.edit',
            compact('inventoryRequest',
                'categories',
                'bladesName',
                'formType',
                'type',
                'data'
            )
        );
    }

    public function transferDetail(InventoryRequest $inventoryRequest, $formData, $page = 'create')
    {
        list($bladesName, $categories, $data) = $formData;
        $type = $inventoryRequest->type;

        return view('ims::inventory.request.transfer', compact(
            'bladesName',
            'categories',
            'type',
            'data',
            'page'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateInventoryRequestPostRequest $request
     * @param string $type
     * @param InventoryRequest $inventoryRequest
     * @return Response
     */
    public function storeDetail(
        CreateInventoryRequestPostRequest $request,
        string $type,
        InventoryRequest $inventoryRequest
    ) {
        if ($this->inventoryRequestService->storeAndUpdateDetail($request->all(), $type, $inventoryRequest)) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('inventory-request.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param CreateInventoryRequestPostRequest $request
     * @param string $type
     * @param InventoryRequest $inventoryRequest
     * @return Response
     */
    public function updateDetail(
        CreateInventoryRequestPostRequest $request,
        string $type,
        InventoryRequest $inventoryRequest
    ) {
        if ($this->inventoryRequestService->storeAndUpdateDetail($request->all(), $type, $inventoryRequest)) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('inventory-request.workflow.show', $inventoryRequest->id);
    }

    /**
     * Show the specified resource.
     * @param InventoryRequest $inventoryRequest
     * @return Response
     */
    public function show(InventoryRequest $inventoryRequest)
    {
        return view('ims::inventory.request.show', compact('inventoryRequest'));
    }

//    public function review(InventoryRequest $inventoryRequest)
//    {
//        return view('ims::inventory-request.review.show', compact('inventoryRequest'));
//    }
//
//    public function processReview(InventoryRequestReviewRequest $inventoryRequestReviewRequest)
//    {
//        dd($inventoryRequestReviewRequest);
//    }

}
