<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\SpecialGroupService;

class SpecialGroupController extends Controller
{

    /**
     * @var $specialGroupService;
     */

     private $specialGroupService;

     /**
      * @param SpecialGroupService $specialGroupService;
      */

      public function __construct(SpecialGroupService $specialGroupService)
      {
          $this->specialGroupService = $specialGroupService;
      }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $groups = $this->specialGroupService->findAll();

        return view('cafeteria::special-group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";

        return view('cafeteria::special-group.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->specialGroupService->save($request->all());

        return redirect()->route('special-groups.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cafeteria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->specialGroupService->findOrFail($id);
        $page = "edit";
        return view('cafeteria::special-group.create', compact('group', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->specialGroupService->findOrFail($id)->update($request->all());

        return redirect()->route('special-groups.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->specialGroupService->findOrFail($id)->delete();

        return redirect()->route('special-groups.index')->with('success', __('labels.delete_success'));
    }

    public function getGroupDataForBill(Request $request)
    {
        $group = $this->specialGroupService->findOne($request->group_id);

        return response()->json($group);
    }
}
