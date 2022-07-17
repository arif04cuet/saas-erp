<?php

namespace Modules\IMS\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\InventoryCategoryGroup;
use Modules\IMS\Services\InventoryCategoryGroupService;

class InventoryCategoryGroupController extends Controller
{


    /**
     * @var InventoryCategoryGroupService
     */
    private $inventoryCategoryGroupService;

    public function __construct(InventoryCategoryGroupService $inventoryCategoryGroupServiceService)
    {
        /** @var InventoryCategoryGroupService $inventoryCategoryGroupServiceService */
        $this->inventoryCategoryGroupService = $inventoryCategoryGroupServiceService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $groups = $this->inventoryCategoryGroupService->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
//        dd($groups);
        return view('ims::inventory.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ims::inventory.group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->inventoryCategoryGroupService->save($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory-category-group.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $group = $this->inventoryCategoryGroupService->findOne($id);
        $categories = optional($group)->categories ?? [];
        return view('ims::inventory.group.show', compact('group', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->inventoryCategoryGroupService->findOne($id);
        return view('ims::inventory.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $groupId)
    {
       $this->inventoryCategoryGroupService->updateGroup($groupId, $request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory-category-group.index');
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
