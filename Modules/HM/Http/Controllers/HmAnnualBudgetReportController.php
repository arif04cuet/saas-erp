<?php

namespace Modules\HM\Http\Controllers;

use App\Utilities\EnToBnNumberConverter;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Services\FiscalYearService;
use Modules\HM\Entities\HostelBudgetTitle;
use Modules\HM\Services\HmAnnualBudgetReportService;
use Modules\HM\Services\HostelBudgetTitleService;

class HmAnnualBudgetReportController extends Controller
{
    /**
     * @var HmAnnualBudgetReportService
     */
    private $hmAnnualBudgetReportService;

    public function __construct(
        HmAnnualBudgetReportService $hmAnnualBudgetReportService
    ) {
        $this->hmAnnualBudgetReportService = $hmAnnualBudgetReportService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        $hostelBudgetTitles = $this->hmAnnualBudgetReportService->getHostelBudgetTitleForDropdown();
        return view('hm::hostel-budget.report.annual.create', compact('hostelBudgetTitles'));
    }

    /**
     * This is called from ajax in index page
     * Show the form for creating a new resource.
     * @param HostelBudgetTitle $hostelBudgetTitle
     * @return Exception|string
     */
    public function create(HostelBudgetTitle $hostelBudgetTitle)
    {
        try {
            $annualBudgetReportData = $this->hmAnnualBudgetReportService->getAnnualBudgetReportData($hostelBudgetTitle);
            $viewFormationData = $this->hmAnnualBudgetReportService->getViewFormattedData($annualBudgetReportData);
            $view = view('hm::hostel-budget.report.annual.report-content',
                compact('hostelBudgetTitle', 'annualBudgetReportData', 'viewFormationData'))->render();
            return $view;
        } catch (Exception $exception) {
            Log::error('Hostel Annual Budget Report Error: ' . $exception->getMessage() . " Trace:" . $exception->getTraceAsString());
            Session::flash('error', trans('labels.generic_error_message'));
            return $exception;
        }
    }

    public function print(HostelBudgetTitle $hostelBudgetTitle)
    {
        try {
            $annualBudgetReportData = $this->hmAnnualBudgetReportService->getAnnualBudgetReportData($hostelBudgetTitle);
            $viewFormationData = $this->hmAnnualBudgetReportService->getViewFormattedData($annualBudgetReportData);
            return view('hm::hostel-budget.report.annual.report',
                compact('annualBudgetReportData', 'viewFormationData', 'hostelBudgetTitle'));
        } catch (Exception $exception) {
            Log::error('Hostel Annual Budget Report Error: ' . $exception->getMessage() . " Trace:" . $exception->getTraceAsString());
            Session::flash('error', trans('labels.generic_error_message'));
            return $exception;
        }
    }
}
