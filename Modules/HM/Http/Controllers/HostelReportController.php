<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HM\Services\HostelReportService;

class HostelReportController extends Controller
{
    private $hostelReportService;

    public function __construct(HostelReportService $hostelReportService)
    {
        $this->hostelReportService = $hostelReportService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $fromDate = date('Y-m-01');
        $toDate = date('Y-m-t');
        $reports = $this->hostelReportService->getCollectionRegisterReport([$fromDate, $toDate]);
        return view('hm::reports.collection.index', compact('reports', 'fromDate', 'toDate'));
    }


    public function filterCollectionRegister(Request $request)
    {
        $fromDate = $request->period_from;
        $toDate = $request->period_to;
        $reports = $this->hostelReportService->getCollectionRegisterReport([$fromDate, $toDate]);
        return view('hm::reports.collection.index', compact('reports', 'fromDate', 'toDate'));
    }

    public function printView($fromDate, $toDate)
    {
        $reports = $this->hostelReportService->getPrintData([$fromDate, $toDate]);
        $fromDay = date("j", strtotime($fromDate));
        $toDay = date("j", strtotime($toDate));
        $fromMonthYear = date("F, Y", strtotime($fromDate));
        $toMonthYear = date("F, Y", strtotime($toDate));
        return view('hm::reports.collection.print-view', compact(
            'reports', 'fromDate', 'toDate', 'fromMonthYear', 'toMonthYear', 'fromDay', 'toDay'
        ));
    }


}
