<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\HouseHistory;

class HouseHistoryRepository extends AbstractBaseRepository
{

    protected $modelName = HouseHistory::class;

    public function updateSecondLastRecord($houseData)
    {
        $secondLastRecord = $this->model->where('house_details_id', $houseData->house_details_id)->skip(1)->latest()->first();

        if ($secondLastRecord) {
            $this->model->where("id", $secondLastRecord->id)->update(['to_date' => $houseData->from_date]);
        }

        return true;
    }

}
