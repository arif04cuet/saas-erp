<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 12/31/18
 * Time: 6:16 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\HM\Entities\CheckinDetail;

class CheckinRepository extends AbstractBaseRepository
{
    protected $modelName = CheckinDetail::class;

    public function countByRoom($roomId)
    {
        return $this->model->where('room_id', $roomId)->where('checkout_date', null)->count();
    }

    public function getCheckinInfoRoomIdAndCheckinId($roomId, $checkinId)
    {
        $assignedGuest = $this->model->whereRoomId($roomId)->whereCheckinId($checkinId)->get();

        $guestList = [];
        foreach ($assignedGuest as $key => $guest) {
            $guestList[$key] = $guest->checkinGuest->toArray();
        }
        return $guestList;

    }

    /**
     * Get all the checkin Details by array of checkinIds
     * @param array $checkinIds
     * @return Builder[]|Collection
     */
    public function getDetailsByCheckinIds(array $checkinIds)
    {
        return $this->getModel()->newQuery()->whereIn('checkin_id', $checkinIds)->get();
    }
}
