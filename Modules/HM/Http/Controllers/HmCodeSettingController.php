<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\HM\Http\Requests\HmCodeSettingRequest;
use Modules\HM\Services\HmCodeSettingService;

class HmCodeSettingController extends Controller
{
    /**
     * @var HmCodeSettingService
     */
    private $hmCodeSettingService;

    public function __construct(HmCodeSettingService $hmCodeSettingService)
    {
        $this->hmCodeSettingService = $hmCodeSettingService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        $codeSettings = $this->hmCodeSettingService->findAll(
            null,
            null,
            ['direction' => 'desc', 'column' => 'created_at']
        );
        return view('hm::accounts.code-setting.index', compact('codeSettings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View
     */
    public function create()
    {
        $economyCodes = $this->hmCodeSettingService->getEconomyCodesForDropdown();
        $journals = $this->hmCodeSettingService->getJournalsForDropdown();
        $hostelBudgetSections = $this->hmCodeSettingService->getHostelBudgetSectionForDropdown();
        session(['_old_input.code_settings' => collect()]);
        return view('hm::accounts.code-setting.create', compact('economyCodes', 'journals', 'hostelBudgetSections'));
    }

    /**
     * Store a newly created resource in storage.
     * @param HmCodeSettingRequest $request
     * @return RedirectResponse
     */
    public function store(HmCodeSettingRequest $request)
    {
        if ($this->hmCodeSettingService->store($request->all())) {
            return redirect()
                ->route('hm.accounts.code-setting.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()
                ->route('hm.accounts.code-setting.index')
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Factory|Application|View
     */
    public function show($id)
    {
        return view('hm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|Application|View
     */
    public function edit()
    {
        $codeSettings = $this->hmCodeSettingService->findAll();
        $economyCodes = $this->hmCodeSettingService->getEconomyCodesForDropdown();
        $journals = $this->hmCodeSettingService->getJournalsForDropdown();
        $hostelBudgetSections = $this->hmCodeSettingService->getHostelBudgetSectionForDropdown();
        session(['_old_input.code_settings' => $codeSettings]);
        return view('hm::accounts.code-setting.edit', compact('economyCodes', 'journals', 'hostelBudgetSections'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(HmCodeSettingRequest $request)
    {
        if ($this->hmCodeSettingService->updateData($request->all())) {
            return redirect()
                ->route('hm.accounts.code-setting.index')
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('hm.accounts.code-setting.index')
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
