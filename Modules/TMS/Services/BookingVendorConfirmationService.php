<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Collection;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Repositories\RoomBookingRepository;
use Modules\HM\Services\BookingRequestService;
use Modules\TMS\Repositories\BookingVendorConfirmationRepository;

class BookingVendorConfirmationService
{
    use CrudTrait;

    /**
     * @var RoomBookingRepository
     */
    private $roomBookingRepository;

    /**
     * BookingVendorConfirmationService constructor.
     * @param BookingVendorConfirmationRepository $bookingVendorConfirmationRepository
     * @param RoomBookingRepository $roomBookingRepository
     */
    public function __construct(
        BookingVendorConfirmationRepository $bookingVendorConfirmationRepository,
        RoomBookingRepository $roomBookingRepository
    ) {
        $this->setActionRepository($bookingVendorConfirmationRepository);
        $this->roomBookingRepository = $roomBookingRepository;
    }

    public function getExpiredPhysicalFacilityBookingRequests()
    {
        $expiredBookings = $this->actionRepository->getExpiredBookings();
        $expiredPhysicalFacilityRequestIds = $expiredBookings->pluck('physical_facility_request_id');
        return $this->roomBookingRepository->getExpiredRoomBookingsByPhysicalFacilityRequest($expiredPhysicalFacilityRequestIds->toArray());
    }

    /**
     * Reject Request which are expired
     * @return Collection
     */
    public function rejectExpiredPhysicalFacilityBookingRequests()
    {
        $expiredBookingRequests = $this->getExpiredPhysicalFacilityBookingRequests();
        $statuses = RoomBooking::getStatuses();
        $deletedModels = collect();
        foreach ($expiredBookingRequests as $expiredBookingRequest) {
            $deletedModels[] = $this->roomBookingRepository->update($expiredBookingRequest,
                ['status' => $statuses['rejected']]);
        }
        return $deletedModels;
    }


}

