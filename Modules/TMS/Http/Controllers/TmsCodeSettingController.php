<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\TMS\Http\Requests\TmsCodeSettingRequest;
use Modules\TMS\Services\TmsCodeSettingService;

class TmsCodeSettingController extends Controller
{
    /**
     * @var TmsCodeSettingService
     */
    private $tmsCodeSettingService;

    public function __construct(TmsCodeSettingService $tmsCodeSettingService)
    {
        $this->tmsCodeSettingService = $tmsCodeSettingService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $codeSettings = $this->tmsCodeSettingService->findAll(null, null,
            ['direction' => 'desc', 'column' => 'created_at']);
        return view('tms::accounts.code-setting.index', compact('codeSettings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View
     */
    public function create()
    {
        $economyCodes = $this->tmsCodeSettingService->getEconomyCodesForDropdown();
        $journals = $this->tmsCodeSettingService->getJournalsForDropdown();
        $tmsSubSectors = $this->tmsCodeSettingService->getTmsSubSectorsForDropdown();
        session(['_old_input.code_settings' => collect()]);
        return view('tms::accounts.code-setting.create', compact('economyCodes', 'journals', 'tmsSubSectors'));
    }

    /**
     * Store a newly created resource in storage.
     * @param TmsCodeSettingRequest $request
     * @return RedirectResponse
     */
    public function store(TmsCodeSettingRequest $request)
    {
        if ($this->tmsCodeSettingService->store($request->all())) {
            return redirect()
                ->route('tms.code-setting.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()
                ->route('tms.code-setting.index')
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('tms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Factory|Application|View
     */
    public function edit()
    {
        $codeSettings = $this->tmsCodeSettingService->findAll();
        $economyCodes = $this->tmsCodeSettingService->getEconomyCodesForDropdown();
        $journals = $this->tmsCodeSettingService->getJournalsForDropdown();
        $tmsSubSectors = $this->tmsCodeSettingService->getTmsSubSectorsForDropdown();
        session(['_old_input.code_settings' => $codeSettings]);
        return view('tms::accounts.code-setting.edit', compact('economyCodes', 'journals', 'tmsSubSectors'));
    }

    /**
     * Update the specified resource in storage.
     * @param TmsCodeSettingRequest $request
     * @return RedirectResponse
     */
    public function update(TmsCodeSettingRequest $request)
    {
        if ($this->tmsCodeSettingService->updateData($request->all())) {
            return redirect()
                ->route('tms.code-setting.index')
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('tms.code-setting.index')
                ->with('error', trans('labels.update_fail'));
        }
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
