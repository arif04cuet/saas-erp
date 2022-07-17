<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\TMS\Services\TmsAccountsReportService;
use Modules\TMS\Services\TrainingsService;

class TmsAccountsReportController extends Controller
{
    /**
     * @var TrainingsService
     */
    private $trainingsService;
    /**
     * @var TmsAccountsReportService
     */
    private $tmsAccountsReportService;

    /**
     * TmsAccountsReportController constructor.
     * @param TmsAccountsReportService $tmsAccountsReportService
     * @param TrainingsService $trainingsService
     */
    public function __construct(TmsAccountsReportService $tmsAccountsReportService, TrainingsService $trainingsService)
    {
        $this->tmsAccountsReportService = $tmsAccountsReportService;
        $this->trainingsService = $trainingsService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|RedirectResponse|View
     */
    public function index(Request $request)
    {
        if (empty($request->training_id)) {
            $trainings = $this->trainingsService->findAll()->pluck('title', 'id');
            return view('tms::accounts.report.index', compact('trainings'));
        }

        return redirect()->route('tms-accounts-reports.show', [$request->training_id, $request->report_type]);
    }

    /**
     * Show the specified resource.
     * @param $trainingId
     * @param $reportType
     * @return Factory|View
     */
    public function show($trainingId, $reportType)
    {
        $trainings = $this->trainingsService->findAll()->pluck('title', 'id');
        $training = $this->trainingsService->findOne($trainingId);
        if ($reportType === config('constants.tms_accounts_report_types.expenditure')) {
            $data = $this->tmsAccountsReportService->prepareExpenditureData($trainingId);
//            dd($data[0]);
        } elseif ($reportType === config('constants.tms_accounts_report_types.budget')) {
            $data = $this->tmsAccountsReportService->prepareBudgetData($trainingId);
        }
        return view(
            'tms::accounts.report.index',
            compact('trainings', 'training', 'trainingId', 'reportType', 'data')
        );
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('tms::edit');
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
