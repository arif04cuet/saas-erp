<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Entities\Sales;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Services\TrainingsService;
use Modules\Cafeteria\Entities\PurchaseItemList;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Services\CafeteriaReportService;

class CafeteriaReportController extends Controller
{
    /**
     * @var $rawMaterialService
     * @var $cafeteriaReportService
     * @var $employeeService
     * @var $trainingsService
     */

    private $rawMaterialService;
    private $cafeteriaReportService;
    private $employeeService;
    private $trainingsService;


    /**
     * @param RawMaterialService $rawMaterialService
     * @param CafeteriaReportService $cafeteriaReportService
     * @param EmployeeService $employeeService
     * @param TrainingsService $trainingsService
     */

    public function __construct(
        RawMaterialService $rawMaterialService,
        CafeteriaReportService $cafeteriaReportService,
        EmployeeService $employeeService,
        TrainingsService $trainingsService
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->cafeteriaReportService = $cafeteriaReportService;
        $this->employeeService = $employeeService;
        $this->trainingsService = $trainingsService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function purchaseItemListReportForm()
    {
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'raw-item'],
            false
        );

        $reportTypes = PurchaseItemList::getReportTypes();

        return view('cafeteria::report.purchase-list.report', compact('rawMaterials', 'reportTypes'));
    }

    public function purchaseItemListReport(Request $request)
    {
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'raw-item'],
            false
        );

        $reportTypes = PurchaseItemList::getReportTypes();

        if ($request->report_type == "date-wise") {
            $listData = $this->cafeteriaReportService->getPurchaseItemListDataByDateWise($request);
        } else {
            $listData = $this->cafeteriaReportService->getPurchaseItemListDataByProductWise($request);
        }

        return view('cafeteria::report.purchase-list.report', compact('rawMaterials', 'listData', 'reportTypes'));
    }

    public function salesReportForm()
    {
        $paymentTypes = Sales::getPaymentTypes();
        $billerTypes = Sales::getBillerTypes();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $trainings = $this->trainingsService->getTrainingsForDropdown();
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown();

        return view('cafeteria::report.sales.report', compact(
            'paymentTypes',
            'billerTypes',
            'employees',
            'trainings',
            'rawMaterials'
        ));
    }

    public function salesReport(Request $request)
    {
        $paymentTypes = Sales::getPaymentTypes();
        $billerTypes = Sales::getBillerTypes();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $trainings = $this->trainingsService->getTrainingsForDropdown();
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown();

        $salesData = $this->cafeteriaReportService->getSalesReportData($request);

        return view('cafeteria::report.sales.report', compact(
            'paymentTypes',
            'billerTypes',
            'employees',
            'trainings',
            'rawMaterials',
            'salesData'
        ));
    }
}
