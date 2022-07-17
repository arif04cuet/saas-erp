<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Services\TmsSectorService;

class TmsSectorController extends Controller
{
    /**
     * @var TmsSectorService
     */
    private $tmsSectorService;

    /**
     * TmsSectorController constructor.
     * @param TmsSectorService $tmsSectorService
     */
    public function __construct(TmsSectorService $tmsSectorService)
    {
        $this->tmsSectorService = $tmsSectorService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sectors = $this->tmsSectorService->findAll();
        return view('tms::budget.sector.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {
        $page = 'create';
        return view('tms::budget.sector.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $save = $this->tmsSectorService->store($request->all());
        if ($save) {
            return redirect()->route('tms-sectors.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $sector = $this->tmsSectorService->findOne($id);
        return view('tms::budget.sector.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $sector = $this->tmsSectorService->findOne($id);
        $page = 'edit';

        return view('tms::budget.sector.create', compact('sector', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $update = $this->tmsSectorService->updateSector($request->all(), $id);
        if ($update) {
            return redirect()->route('tms-sectors.show', $id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->tmsSectorService->deleteSector($id);
        return redirect()->back();
    }
}
