<?php

namespace Modules\IMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\IMS\Http\Requests\ProcurementAndBillSettingRequest;
use Modules\IMS\Services\ProcurementAndBillSettingService;

class ProcurementAndBillSettingController extends Controller
{
    /**
     * @var ProcurementAndBillSettingService
     */
    private $billSettingService;

    /**
     * ProcurementAndBillSettingController constructor.
     * @param ProcurementAndBillSettingService $billSettingService
     */
    public function __construct(ProcurementAndBillSettingService $billSettingService)
    {
        $this->billSettingService = $billSettingService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = $this->billSettingService->findAll();
        return view('ims::procurement-billing.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        list($economyCodes, $journals, $billTypes) = $this->billSettingService->getFormElements();
        return view(
            'ims::procurement-billing.settings.create',
            compact('economyCodes', 'journals', 'billTypes')
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProcurementAndBillSettingRequest $request)
    {
        if ($this->billSettingService->store($request->all())) {
            return redirect()->route('procurement-bill-settings.index')
                ->with('success', __('labels.save_success'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $setting = $this->billSettingService->findOne($id);
        if (!$setting) {
            return redirect()->route('procurement-bill-settings.index')->with('error', __('labels.not_found'));
        }
        return view('ims::procurement-billing.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = $this->billSettingService->findOne($id);
        if (!$setting) {
            return redirect()->route('procurement-bill-settings.index')->with('error', __('labels.not_found'));
        }
        list($economyCodes, $journals, $billTypes) = $this->billSettingService->getFormElements();

        return view(
            'ims::procurement-billing.settings.edit',
            compact('setting', 'economyCodes', 'journals', 'billTypes')
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProcurementAndBillSettingRequest $request, $id)
    {
        if ($this->billSettingService->updateSetting($request->all(), $id)) {
            return redirect()->route('procurement-bill-settings.show', $id)
                ->with('success', __('labels.update_success'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activation($id)
    {
        $setting = $this->billSettingService->findOne($id);
        if ($setting->status == 'active') {
            $setting->update(['status' => 'inactive']);
        } else {
            $setting->update(['status' => 'active']);
        }
        return redirect()->back()->with('success', __('labels.update_success'));
    }

    public function getData($id)
    {
        return $this->billSettingService->findOne($id) ?? [];
    }
}
