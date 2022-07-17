<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/1/19
 * Time: 2:46 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Modules\HM\Entities\RoomBookingRequester;

class RoomBookingRequesterRepository extends AbstractBaseRepository
{
    protected $modelName = RoomBookingRequester::class;

    public function pluckContactBookingId()
    {
        $data = $this->model->whereHas('roomBooking', function ($query) {
            $query->where('type', 'booking');
            $query->where('status', 'approved');
        })->get();

        $valueClosure = function ($d) {
            return $d->contact . ' (' . Carbon::parse($d->roomBooking->created_at)
                    ->format('Y-m-d') . ')';
        };
        $keyClosure = function ($d) {
            return $d->room_booking_id;
        };
        return DropDownDataFormatter::getFormattedDataForDropdown($data, $keyClosure, $valueClosure);
    }
}
