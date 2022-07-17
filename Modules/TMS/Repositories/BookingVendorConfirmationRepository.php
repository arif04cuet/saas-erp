<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\HM\Entities\BookingVendorConfirmation;

class BookingVendorConfirmationRepository extends AbstractBaseRepository
{

    protected $modelName = BookingVendorConfirmation::class;


    public function getExpiredBookings()
    {
        $today = Carbon::today()->format('Y-m-d');
        return $this->model->newQuery()->where('last_validity', '<', $today)->get();
    }

}
