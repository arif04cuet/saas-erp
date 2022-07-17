<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Accounts\Services\EconomySectorService;

class EconomySectorController extends Controller
{
    /**
     * @var EconomySectorService
     */
    private $economySectorService;

    /**
     * EconomySectorController constructor.
     * @param EconomySectorService $economySectorService
     */
    public function __construct(EconomySectorService $economySectorService)
    {
        $this->economySectorService = $economySectorService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $economySectors = $this->economySectorService->findAll();
        return view('accounts::economy-sector.index', compact('economySectors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $economyCodes = $this->economySectorService->getEconomyCodeForDropdown();
        return view('accounts::economy-sector.create', compact('economyCodes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->economySectorService->saveSector($request->all())) {
            return redirect()->route('economy-sectors.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $economySector = $this->economySectorService->findOne($id);
        $economyCodes = $this->economySectorService->getEconomyCodeForDropdown();
        return view('accounts::economy-sector.edit', compact('economyCodes','economySector'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->economySectorService->updateSector($request->all(), $id);
        return redirect()->back();
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
     * Method that returns json of sectors of an economy code
     * @param $economyCode
     * @return false|string |null
     */
    public function getSectorsJson($economyCode)
    {
        $economySectors = $this->economySectorService->getSectors($economyCode);
        $data = [];
        foreach ($economySectors as $economySector) {
            $data[] = [
                'title' => App::getLocale() == 'bn'? $economySector->title_bangla : $economySector->title,
                'economy_sector_code' => $economySector->code,
                'id' => $economySector->id
            ];
        }
        return json_encode($data);
    }
}
