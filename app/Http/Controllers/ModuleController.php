<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ModuleService;
use App\Http\Requests\ModuleRequest;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
{
    private $moduleService;
    const MODEL = 'Module';
    // use Authorizable;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
        // $this->authorizeResource(Module::class);
    }

    public function index()
    {
        $this->authorize('view_modules');
        $modules = $this->moduleService->index();
        return view('module.index', compact('modules'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', self::MODEL);
        return view('module.create');
    }

    public function store(ModuleRequest $request)
    {
        $this->authorize('create', self::MODEL);
        $this->moduleService->store($request);
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('module.index');
    }

    public function show($id)
    {
        $this->authorize('view', self::MODEL);
        $module = $this->moduleService->find($id);
        return view('module.show', compact('module'));
    }

    public function edit($id)
    {
        $this->authorize('update', self::MODEL);
        $module = $this->moduleService->find($id);
        return view('module.edit', compact('module'));
    }

    public function update(ModuleRequest $request, $id)
    {
        $this->authorize('update', self::MODEL);
        $this->moduleService->update($id, $request);
        Session::flash('success', trans('labels.update_success'));
        return redirect()->route('module.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', self::MODEL);
        $response = $this->moduleService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('module.index');
    }
}
