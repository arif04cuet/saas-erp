<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 12/31/18
 * Time: 6:58 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\HM\Entities\BookingGuestInfo;

class BookingGuestInfoRepository extends AbstractBaseRepository
{
    protected $modelName = BookingGuestInfo::class;

    public function pluckByBookingIdAndStatus($roomBookingId, $status)
    {
        return $this->model->where('room_booking_id', $roomBookingId)->where('status', $status)->pluck('first_name',
            'id');
    }

    /**
     * @param $bookingGuestInfo
     * @param $status
     * @return Model
     */
    public function changeStatusOfGuest($bookingGuestInfo, $status)
    {
        $guestInfo = $this->findOne($bookingGuestInfo);
        return $this->update($guestInfo, ['status' => $status]);
    }
}
