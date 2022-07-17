<?php

namespace Modules\IMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\IMS\Entities\InventoryItemRequest;
use Modules\IMS\Services\InventoryItemService;
use Modules\IMS\Services\InventoryLocationService;
use Modules\IMS\Services\InventoryItemRequestService;
use Modules\TMS\Services\TrainingsService;

class InventoryItemRequestController extends Controller
{

    /**
     * @var InventoryItemRequestService
     */
    private $inventoryItemRequestService;
    /**
     * @var InventoryLocationService
     */
    private $inventoryLocationService;
    /**
     * @var TrainingsService
     */
    private $trainingService;

    public function __construct(
        InventoryLocationService $inventoryLocationService,
        TrainingsService $trainingService,
        InventoryItemRequestService $inventoryItemRequestService
    ) {
        $this->inventoryItemRequestService = $inventoryItemRequestService;
        $this->trainingService = $trainingService;
        $this->inventoryLocationService = $inventoryLocationService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $inventoryItemRequests = $this->inventoryItemRequestService->findAll(null, null,
            ['column' => 'created_at', 'direction' => 'desc']);
        $statusCssArray = $this->inventoryItemRequestService->getStatusCssArray();
        return view('ims::inventory.item.request.index', compact('inventoryItemRequests', 'statusCssArray'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $locations = $this->inventoryLocationService->getLocationsForDropdown();
        $inventoryItemsByLocation = $this->inventoryItemRequestService->getInventoryItemsByLocation();
        $items = $this->inventoryItemRequestService->getItemsForDropdown();
        $purposes = $this->inventoryItemRequestService->getPurposes();
        $trainings = $this->trainingService->getTrainingsForDropdown();
        $this->inventoryItemRequestService->clearOldSessionValues();
        return view('ims::inventory.item.request.create',
            compact('locations', 'items', 'purposes', 'trainings', 'inventoryItemsByLocation'));
    }

    public function show(InventoryItemRequest $inventoryItemRequest)
    {
        return view('ims::inventory.item.request.show',
            compact('inventoryItemRequest'));

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->inventoryItemRequestService->store($request->all())) {
            $successMessage = trans('labels.save_success');
            if (Session::has('success')) {
                $successMessage = Session::get('success');
            }
            return redirect()->route('inventory-item-request.index')->with('success', $successMessage);
        } else {
            $errorMessage = trans('labels.save_fail');
            if (Session::has('error')) {
                $errorMessage = Session::get('error');
            }
            return redirect()->route('inventory-item-request.index')->with('error', $errorMessage)
                ->with('old', session()->getOldInput());;
        }
    }

    public function edit(InventoryItemRequest $inventoryItemRequest)
    {
        $locations = $this->inventoryLocationService->getLocationsForDropdown();
        $inventoryItemsByLocation = $this->inventoryItemRequestService->getInventoryItemsByLocation();
        $items = $inventoryItemsByLocation[$inventoryItemRequest->inventory_location_id];
        $purposes = $this->inventoryItemRequestService->getPurposes();
        $trainings = $this->trainingService->getTrainingsForDropdown();
        $this->inventoryItemRequestService->setOldSessionvalues($inventoryItemRequest);
        return view('ims::inventory.item.request.edit',
            compact('locations', 'items', 'purposes', 'trainings', 'inventoryItemsByLocation', 'inventoryItemRequest'));
    }

    public function update(Request $request, InventoryItemRequest $inventoryItemRequest)
    {
        if ($this->inventoryItemRequestService->updateData($request->all(), $inventoryItemRequest)) {
            $successMessage = trans('labels.save_success');
            if (Session::has('success')) {
                $successMessage = Session::get('success');
            }
            return redirect()->route('inventory-item-request.index')->with('success', $successMessage);
        } else {
            $errorMessage = trans('labels.save_fail');
            if (Session::has('error')) {
                $errorMessage = Session::get('error');
            }
            return redirect()->route('inventory-item-request.index')->with('error', $errorMessage)
                ->with('old', session()->getOldInput());;
        }
    }

    public function tmsIndex()
    {
        $purpose = InventoryItemRequest::getPurpose()['training'];
        $inventoryItemRequests = $this->inventoryItemRequestService->findBy(['purpose' => $purpose]);
        $statusCssArray = $this->inventoryItemRequestService->getStatusCssArray();
        return view('tms::inventory.item.index', compact('inventoryItemRequests', 'statusCssArray'));
    }
}
