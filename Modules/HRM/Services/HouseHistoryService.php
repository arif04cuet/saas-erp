<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Repositories\HouseHistoryRepository;

class HouseHistoryService
{
    use CrudTrait;

    /**
     * @var HouseHistoryRepository
     */

    private $houseHistoryRepository;

    public function __construct(
        HouseHistoryRepository $historyRepository
    ) {
        $this->houseHistoryRepository = $historyRepository;
        $this->setActionRepository($this->houseHistoryRepository);
    }

    public function storeHistory($houseData)
    {
        $historyArr = [
            'house_details_id' => $houseData->id,
            'employee_id' => $houseData->allocated_to,
            'from_date' => date("Y-m-d H:i:s"),
            'status' => $houseData->status
        ];

        $save = $this->houseHistoryRepository->save($historyArr);

        return $this->houseHistoryRepository->updateSecondLastRecord($save);
    }
}

