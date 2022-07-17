<?php

namespace Modules\HM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\RoomBooking;

class CheckInApprovedTrainingRepository extends AbstractBaseRepository
{
    // same table is being used for both request and checkin
    protected $modelName = RoomBooking::class;

}
