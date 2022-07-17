<?php

namespace Modules\Cafeteria\Services;

use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Repositories\PurchaseItemListRepository;
use Modules\Cafeteria\Repositories\SalesRepository;

class CafeteriaReportService
{
    /**
     * @var $rawMaterialService
     * @var $purchaseListRepository
     * @var $salesRepository
     */

    private $rawMaterialService;
    private $purchaseItemListRepository;
    private $salesRepository;

    /**
     * @param RawMaterialService $rawMaterialService
     * @param PurchaseListRepository $purchaseListRepository
     * @param SalesRepository $salesRepository
     */

    public function __construct(
        RawMaterialService $rawMaterialService,
        PurchaseItemListRepository $purchaseItemListRepository,
        SalesRepository $salesRepository
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->purchaseItemListRepository = $purchaseItemListRepository;
        $this->salesRepository = $salesRepository;
    }

    public function getPurchaseItemListDataByProductWise($request)
    {
        $reportData = $this->purchaseItemListRepository->purchaseReportDataByProductWise($request);

        $listData = [];
        foreach($reportData as $item) {
            $tempArr = [];
            $rawMaterial = $this->rawMaterialService->findOne($item->raw_material_id);
            $tempArr['raw_material_bn_name'] = $rawMaterial->bn_name;
            $tempArr['raw_material_en_name'] = $rawMaterial->en_name;
            $tempArr['unit_bn_name'] = $rawMaterial->unit->bn_name;
            $tempArr['unit_en_name'] = $rawMaterial->unit->en_name;
            $tempArr['quantity'] = $item->quantity;
            $tempArr['total_price'] = $item->total_price;
            $listData[] = (object) $tempArr;
        }

        return collect($listData);
    }

    public function getPurchaseItemListDataByDateWise($request)
    {
        return $this->purchaseItemListRepository->purchaseReportDataByDateWise($request);
    }

    public function getSalesReportData($request) 
    {
        // $ls = $this->salesRepository->getSalesFilterData($request);
        // dd($ls);
        return $this->salesRepository->getSalesFilterData($request);
    }
}

