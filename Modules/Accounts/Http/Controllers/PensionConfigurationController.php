<?php

namespace Modules\Accounts\Http\Controllers;

use Exception;
use http\Encoding\Stream\Inflate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Modules\Accounts\Entities\EmployeeLumpSum;
use Modules\Accounts\Entities\PensionConfiguration;
use Modules\Accounts\Http\Requests\PensionConfigurationRequest;
use Modules\Accounts\Services\PensionConfigurationService;
use Modules\Accounts\Services\PensionRuleService;

class PensionConfigurationController extends Controller
{
    private $service;
    private $pensionRuleService;

    public function __construct(
        PensionConfigurationService $pensionConfigurationService,
        PensionRuleService $pensionRuleService
    )
    {
        $this->service = $pensionConfigurationService;
        $this->pensionRuleService = $pensionRuleService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $pensionConfigurations = $this->service->findAll(null, null,
            ['column' => 'created_at', 'direction' => 'desc']);
        return view('accounts::pension-configuration.index', compact('pensionConfigurations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create()
    {
        $action = 'create';
        return view('accounts::pension-configuration.create', compact('action'));
    }

    /**
     * @param PensionConfigurationRequest $request
     * @return RedirectResponse
     */
    public function store(PensionConfigurationRequest $request)
    {
        // set the status flag
        if (isset($request->status)) {
            $this->service->deactivateOtherStatus();
            $request['status'] = PensionConfiguration::status[0];
        } else {
            $request['status'] = PensionConfiguration::status[1];
        }
        $validatedData = $request->validate([
            'title' => 'required',
            'percentage' => 'nullable',
            'lump_sum_number' => 'nullable',
            'lump_sum_percentage' => 'nullable',
            'monthly_pension_percentage' => 'nullable',
            'minimum_pension_amount' => 'nullable',
            'medical_increment_age' => 'nullable',
            'status' => 'nullable',
        ]);
        $pensionConfiguration = $this->service->save($validatedData);
        if (!is_null($pensionConfiguration) && !empty($request->pension)) {
            foreach ($request->pension as $data) {
                $data['pension_configuration_id'] = $pensionConfiguration->id;
                $this->pensionRuleService->save($data);
            }
        }
        return redirect()->route('pension-configuration.index')
            ->with('success', trans('labels.save_success'));

    }

    /**
     * Show the specified resource.
     * @param PensionConfiguration $pensionConfiguration
     * @return Factory|View
     */
    public function show(PensionConfiguration $pensionConfiguration)
    {
        return view('accounts::pension-configuration.show',
            compact('pensionConfiguration'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param PensionConfiguration $pensionConfiguration
     * @return Factory|View
     */
    public function edit(PensionConfiguration $pensionConfiguration)
    {
        $action = 'edit';
        return view('accounts::pension-configuration.edit',
            compact('pensionConfiguration', 'action'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // set the status flag
        if (isset($request->status)) {
            $this->service->deactivateOtherStatus();
            $request['status'] = PensionConfiguration::status[0];
        } else {
            $request['status'] = PensionConfiguration::status[1];
        }
        $pensionConfiguration = $this->service->findOne($id);
        if ($pensionConfiguration->update($request->except(['pension'])) &&
            $this->pensionRuleService->update($pensionConfiguration, collect($request->pension))) {
            return redirect()->route('pension-configuration.show', $pensionConfiguration->id)
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('pension-configuration.show', $pensionConfiguration->id)
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * @param PensionConfiguration $pensionConfiguration
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(PensionConfiguration $pensionConfiguration)
    {
        if ($this->service->delete($pensionConfiguration->id)) {
            return redirect()->route('pension-configuration.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('pension-configuration.index')
                ->with('error', trans('labels.save_fail'));
        }
    }

    public function changeStatus($id)
    {
        if ($this->service->changeStatus($this->service->findOne($id))) {
            return redirect()->route('pension-configuration.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('pension-configuration.index')
                ->with('success', trans('labels.save_success'));
        }
    }
}
