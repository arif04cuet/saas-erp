<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\SpecialGroupService;
use Modules\Cafeteria\Services\SpecialGroupBillService;

class SpecialGroupBillController extends Controller
{
    /**
     * @var $specialGroupService;
     * @var $specialGroupBillService;
     */

    private $specialGroupService;
    private $specialGroupBillService;

    /**
     * @param SpecialGroupService $specialGroupService;
     * @param SpecialGroupBillService $specialGroupBillService;
     */

     public function __construct(
         SpecialGroupService $specialGroupService,
         SpecialGroupBillService $specialGroupBillService
    ) {
         $this->specialGroupService = $specialGroupService;
         $this->specialGroupBillService = $specialGroupBillService;
     }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $groups = $this->specialGroupService->getSpecialGroupsForDropdown(null, null, null, true);
        return view('cafeteria::special-group-bill.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $groups = $this->specialGroupService->getSpecialGroupsForDropdown(null, null, null, true);
        $page = "create";

        return view('cafeteria::special-group-bill.create', compact('groups', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->specialGroupBillService->storeSpecialGroupBillData($request->all());

        return redirect()->route('special-group-bills.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $bill = $this->specialGroupBillService->findOne($id);
        return view('cafeteria::special-group-bill.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cafeteria::edit');
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

    /**
     * @param $groupId
     * @return Response JSON
     */

     public function specialBillAsJson(Request $request)
     {
        $billInfo = $this->specialGroupBillService->findBy(['special_group_id' => $request->group_id]);

        return response()->json($billInfo);
     }
}
