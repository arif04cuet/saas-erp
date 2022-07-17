<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Services\CostCenterService;
use Modules\Accounts\Services\EconomyCodeService;

class CostCenterController extends Controller
{
    /**
     * @var CostCenterService
     */
    private $costCenterService;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;

    /**
     * CostCenterController constructor.
     * @param CostCenterService $costCenterService
     * @param EconomyCodeService $economyCodeService
     */
    public function __construct(CostCenterService $costCenterService, EconomyCodeService $economyCodeService)
    {
        $this->costCenterService = $costCenterService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $costCenters = $this->costCenterService->findAll();
        return view('accounts::cost-center.index', compact('costCenters'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $implementedKey = function ($item) {
            return $item->code;
        };
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(
            null,
            $implementedKey,
            null,
            true
        );
        $page = 'create';

        return view('accounts::cost-center.create', compact('economyCodes', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->costCenterService->save($request->all());
        return redirect(route('cost-centers.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param $costCenterId
     * @return Response
     */
    public function show($costCenterId)
    {
        return view('accounts::cost-center.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
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
