<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Repositories\GpfConfigurationRepository;
use Modules\Accounts\Services\GpfConfigurationService;

class GpfConfigurationController extends Controller
{
    /**
     * @var GpfConfigurationService
     */
    private $gpfConfigurationService;

    /**
     * GpfConfigurationController constructor.
     * @param GpfConfigurationService $gpfConfigurationService
     */
    public function __construct(GpfConfigurationService $gpfConfigurationService)
    {

        $this->gpfConfigurationService = $gpfConfigurationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $configurations = $this->gpfConfigurationService->findAll();
        return view('accounts::gpf.configuration.index', compact('configurations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('accounts::gpf.configuration.create')->with('page', 'create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->gpfConfigurationService->saveData($request->all());
        return redirect(route('gpf-configurations.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $configuration = $this->gpfConfigurationService->findOne($id);
        return view('accounts::gpf.configuration.show', compact('configuration'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $configuration = $this->gpfConfigurationService->findOne($id);
        $page = 'edit';
        return view('accounts::gpf.configuration.create', compact('configuration', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->gpfConfigurationService->updateData($request->all(), $id);
        return redirect(route('gpf-configurations.show', $id))->with('success', __('labels.update_success'));
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

    public function toggleActivation($id)
    {
        $this->gpfConfigurationService->toggleActivation($id);
        return redirect(route('gpf-configurations.show', $id))->with('success', __('labels.update_success'));
    }
}
