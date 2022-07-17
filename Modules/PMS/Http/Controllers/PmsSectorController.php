<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PMS\Services\PmsSectorService;

class PmsSectorController extends Controller
{
    /**
     * @var PmsSectorService
     */
    private $pmsSectorService;

    /**
     * TmsSectorController constructor.
     * @param PmsSectorService $pmsSectorService
     */
    public function __construct(PmsSectorService $pmsSectorService)
    {
        $this->pmsSectorService = $pmsSectorService;
    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sectors = $this->pmsSectorService->findAll();
        return view('pms::budget.sector.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = 'create';
        return view('pms::budget.sector.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $save = $this->pmsSectorService->store($request->all());
        if ($save) {
            return redirect()->route('pms-sectors.index');
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
        $sector = $this->pmsSectorService->findOne($id);
        return view('pms::budget.sector.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $sector = $this->pmsSectorService->findOne($id);
        $page = 'edit';

        return view('pms::budget.sector.create', compact('sector', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $update = $this->pmsSectorService->updateSector($request->all(), $id);
        if ($update) {
            return redirect()->route('pms-sectors.show', $id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->pmsSectorService->deleteSector($id);
        return redirect()->back();
    }
}
