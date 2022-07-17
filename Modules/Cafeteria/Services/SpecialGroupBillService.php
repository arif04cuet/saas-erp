<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Cafeteria\Services\SpecialGroupBillListService;
use Modules\Cafeteria\Repositories\SpecialGroupBillRepository;

class SpecialGroupBillService
{
    use CrudTrait;

    /**
     * @var $specialGroupBillRepository
     * @var $specialGroupBillListService
    */

    private $specialGroupBillRepository;
    private $specialGroupBillListService;

    /**
     * @param SpecialGroupBillRepository $specialGroupBillRepository
     * @param SpecialGroupBillListService $specialGroupBillListService
    */

    public function __construct(
        SpecialGroupBillRepository $specialGroupBillRepository,
        SpecialGroupBillListService $specialGroupBillListService
    ) {
        $this->specialGroupBillRepository = $specialGroupBillRepository;
        $this->specialGroupBillListService = $specialGroupBillListService;
        $this->setActionRepository($this->specialGroupBillRepository);
    }

    public function storeSpecialGroupBillData(array $data)
    {
       DB::transaction(function () use($data) {
            $save = $this->save($data);

            foreach($data['bill-entries'] as $item) {
                
                $item['special_group_bill_id'] = $save->id;

                $this->specialGroupBillListService->save($item);
            }
       });
    }
}

