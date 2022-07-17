<?php
/**
 * Created by vs code.
 * User: araf
 * Date: 12/07/2022
 * Time: 3:56 PM
 */

namespace Modules\HM\Services;


use App\Services\RoleService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Modules\HM\Emails\BookingRequestMail;
use Modules\HM\Entities\BookingCheckin;
use Modules\HM\Entities\BookingGuestInfo;
use Modules\HM\Entities\BookingRoomInfo;
use Modules\HM\Entities\BookingVendorConfirmation;
use Modules\HM\Entities\CheckinRoom;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Entities\RoomBookingRequester;
use Modules\HM\Entities\RoomType;
use Modules\HM\Repositories\BookingGuestInfoRepository;
use Modules\HM\Repositories\BookingRequestForwardRepository;
use Modules\HM\Repositories\RoomBookingRepository;
use Modules\HM\Repositories\RoomBookingRequesterRepository;
use MongoDB\Driver\Session;

class BookingRequestService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var RoomBookingRepository
     */
    private $roomBookingRepository;

    private $bookingGuestInfoRepository;
    private $roomBookingRequesterRepository;
    private $bookingRequesteForwardRepository;
    private $roomService;
    private $roleService;
    /**
     * @var RoomTypeService
     */
    private $roomTypeService;

    /**
     * BookingRequestService constructor.
     * @param RoomBookingRepository $roomBookingRepository
     * @param BookingGuestInfoRepository $bookingGuestInfoRepository
     * @param RoomBookingRequesterRepository $roomBookingRequesterRepository
     * @param BookingRequestForwardRepository $bookingRequesteForwardRepository
     * @param RoomTypeService $roomTypeService
     * @param RoomService $roomService
     * @param RoleService $roleService
     */
    public function __construct(
        RoomBookingRepository $roomBookingRepository,
        BookingGuestInfoRepository $bookingGuestInfoRepository,
        RoomBookingRequesterRepository $roomBookingRequesterRepository,
        BookingRequestForwardRepository $bookingRequesteForwardRepository,
        RoomTypeService $roomTypeService,
        RoomService $roomService,
        RoleService $roleService
    ) {
        $this->roomBookingRepository = $roomBookingRepository;
        $this->bookingGuestInfoRepository = $bookingGuestInfoRepository;
        $this->roomBookingRequesterRepository = $roomBookingRequesterRepository;
        $this->bookingRequesteForwardRepository = $bookingRequesteForwardRepository;
        $this->roomTypeService = $roomTypeService;
        $this->roomService = $roomService;
        $this->roleService = $roleService;
        $this->setActionRepository($roomBookingRepository);
    }

    public function store(array $data, $type = 'booking')
    {
        
        return DB::transaction(function () use ($data, $type) {
            // dd($data);
            $data = $this->parseDurationAndOwnRequestInfo($data);
            $data['shortcode'] = time();
            $data['status'] = $this->getStatus($type);
            $data['type'] = $type;
            $data['physical_facility_request_id'] = $data['physical_facility_request_id'] ?? null;
            $roomBooking = $this->save($data);

            $this->saveRequesterInfo($data, $roomBooking);

            $this->saveRoomInfos($roomBooking, $data);

            $this->saveGuestInfos($data, $roomBooking);

            if ($type == 'checkin' && isset($data['booking_id'])) {
                BookingCheckin::create(['checkin_id' => $roomBooking->id, 'booking_id' => (int)$data['booking_id']]);
            }
            if ($type == 'checkin' && isset($data['room_numbers'])) {
                $this->saveRoomNumbers($roomBooking, $data['room_numbers']);
            }
            if ($roomBooking && !empty($data['email'])) {
                Mail::to($data['email'])->send(new BookingRequestMail($roomBooking));
                // Sending mail to director admin
                // TODO: Remove hard coded director admin's email address
                Mail::to('arafwebartists@gmail.com')->send(new BookingRequestMail($roomBooking));
            }

            return $roomBooking;
        });
    }

    /**
     * @param $data
     * @return mixed
     */
    private function parseDurationAndOwnRequestInfo($data)
    {
        $data['start_date'] = Carbon::createFromFormat("j F, Y", $data['start_date']);
        $data['end_date'] = Carbon::createFromFormat("j F, Y", $data['end_date']);
        $data['is_own_request'] = isset($data['is_own_request']) == 'false' ? 0 : 1;
        return $data;
    }

    public function saveRoomNumbers($checkin, $rooms)
    {
        $roomArr = explode(',', $rooms);
        foreach ($roomArr as $room) {
            CheckinRoom::create([
                'checkin_id' => $checkin->id,
                'room_id' => $room
            ]);
            $room = $this->roomService->findOne($room);
            $room->update(['status' => 'unavailable']);
        }
    }

    /**
     * @param $data
     * @param $roomBooking
     */
    private function saveRequesterInfo($data, $roomBooking): void
    {
        $oldRoomBooking = $this->pullOldRoomBooking($data);

        if (isset($data['organization_type']) && isset($data['organization_purpose'])) {
            $data['organization_type'] = $this->prepareRequesterOrgType($data);
        }

        $roomBookingRequester = new RoomBookingRequester($data);

        list($photoPath, $nidDocPath, $passportDocPath) = $this->storeRequesterFiles($data);

        $roomBookingRequester->photo = (!is_null($photoPath)
            ? $photoPath
            : ($this->hasOldFile($oldRoomBooking, 'photo')
                ? $oldRoomBooking->requester->photo
                : null));
        $roomBookingRequester->nid_doc = (!is_null($nidDocPath)
            ? $nidDocPath
            : ($this->hasOldFile($oldRoomBooking, 'nid_doc')
                ? $oldRoomBooking->requester->nid_doc
                : null));
        $roomBookingRequester->passport_doc = (!is_null($passportDocPath)
            ? $passportDocPath
            : ($this->hasOldFile($oldRoomBooking, 'passport_doc')
                ? $oldRoomBooking->requester->passport_doc
                : null));

        $roomBooking->requester()->save($roomBookingRequester);
    }

    /**
     * @param $roomBooking
     * @param $data
     */
    public function saveRoomInfos($roomBooking, $data): void
    {
        $roomBooking->roomInfos()->saveMany(collect($data['roomInfos'])->map(function ($roomInfo) use ($data) {

            $roomType = RoomType::find($roomInfo['room_type_id']);
            $rateType = $this->prepareRequesterOrgType($data);
            $rate = $roomType->{$rateType . '_rate'};

            return new BookingRoomInfo([
                'room_type_id' => $roomInfo['room_type_id'],
                'quantity' => $roomInfo['quantity'],
                'rate_type' => $rateType,
                'rate' => $rate
            ]);
        }));
    }

    /**
     * @param $data
     * @param $roomBooking
     */
    public function saveGuestInfos($data, $roomBooking): void
    {
        /* Save guests info for booking/checkin */

        if (array_key_exists('guests', $data)) {
            $roomBooking->guestInfos()->saveMany(
                collect($data['guests'])->map(function ($guest) use ($roomBooking) {
                    $guest['nid_doc'] = array_key_exists('nid_doc', $guest) ? $this->upload($guest['nid_doc'],
                        'booking-requests') : $this->pullGuestNidDoc($guest);
                    return new BookingGuestInfo($guest);
                })
            );
        }
    }

    public function updateRequest(array $data, RoomBooking $roomBooking)
    {
        DB::transaction(function () use ($data, $roomBooking) {
            $data = $this->parseDurationAndOwnRequestInfo($data);
            $data['status'] = 'pending';

            $this->update($roomBooking, $data);

            foreach ($data['roomInfos'] as $value) {

                $roomType = RoomType::find($value['room_type_id']);
                $rateType = $this->prepareRequesterOrgType($data);
                $rate = $roomType->{$rateType . '_rate'};

                $roomBooking->roomInfos()->updateOrCreate([
                    'id' => $value['id'],
                ], [
                    'room_type_id' => $value['room_type_id'],
                    'quantity' => $value['quantity'],
                    'rate_type' => $rateType,
                    'rate' => $rate
                ]);
            }

            if (isset($data['deleted-roominfos'])) {
                BookingRoomInfo::destroy($data['deleted-roominfos']);
            }

            $this->removeOldFileAttachments(
                $this->removableAttachments($data, ['photo', 'nid_doc', 'passport_doc']),
                $data,
                $roomBooking->requester->toArray()
            );

            list($data['photo'], $data['nid_doc'], $data['passport_doc']) = $this->storeRequesterFiles($data);


            list($data['photo'], $data['nid_doc'], $data['passport_doc']) = $this->replaceRequesterInfo(array_filter($data,
                function ($key) {

                    return in_array($key, ['photo', 'nid_doc', 'passport_doc']);

                }, ARRAY_FILTER_USE_KEY), $roomBooking);


            if (isset($data['organization_type']) && isset($data['organization_purpose'])) {
                $data['organization_type'] = $this->prepareRequesterOrgType($data);
            }

            $roomBooking->requester->update($data);

            $this->updateGuestInfo($roomBooking, $data);

            return $roomBooking;
        });
    }

    private function removeOldFileAttachments(array $keys, array $requestData, array $bookingRequester)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $requestData) && $bookingRequester[$key]) {
                $this->deleteFile($bookingRequester[$key]);
            }
        }
    }

    private function updateGuestInfo($roomBooking, $data): void
    {
        if (array_key_exists('guests', $data)) {

            $allGuestIds = $roomBooking->guestInfos->pluck("id")->toArray();

            foreach ($data['guests'] as $value) {
                if ($value['id']) {
                    if (($key = array_search($value['id'], $allGuestIds)) !== false) {
                        unset($allGuestIds[$key]);
                    }

                    if (array_key_exists('nid_doc', $value)) {
                        $guest = $roomBooking->guestInfos()->find($value['id']);

                        if ($guest->nid_doc) {
                            Storage::delete($guest->nid_doc);
                        }

                        $value['nid_doc'] = $this->uploadGuestNidDoc(
                            $value['nid_doc'],
                            'booking-requests/' . $roomBooking->shortcode . '/guests'
                        );
                    }

                    $roomBooking->guestInfos()->updateOrCreate([
                        'id' => $value['id'],
                    ], $value);

                } else {
                    $value['nid_doc'] = array_key_exists('nid_doc', $value)
                        ? $this->uploadGuestNidDoc(
                            $value['nid_doc'],
                            'booking-requests/' . $roomBooking->shortcode . '/guests'
                        )
                        : null;
                    $roomBooking->guestInfos()->create($value);
                }
            }

            $this->deleteGuestWithNidDocStorage($roomBooking->guestInfos()->find($allGuestIds));
        } else {
            $this->deleteGuestWithNidDocStorage($roomBooking->guestInfos);
        }
    }

    /**
     * @param $guests
     */
    private function deleteGuestWithNidDocStorage($guests): void
    {
        foreach ($guests as $guest) {

            if ($guest->nid_doc) {
                Storage::delete($guest->nid_doc);
            }

            $guest->delete();
        }
    }

    public function getStatus($type)
    {
        switch ($type) {
            case 'booking':
                return 'pending';
            case 'checkin':
                return 'approved';
            default:
                return 'pending';
        }
    }

    public function getBookingGuestInfo($roomBookingId, $status)
    {
        return $this->bookingGuestInfoRepository->pluckByBookingIdAndStatus($roomBookingId, $status);
    }

    public function pluckContactBookingIdForApprovedBooking()
    {
        return $this->roomBookingRequesterRepository->pluckContactBookingId();
    }

    public function pluckTrainingTitleBookingIdForApprovedBooking()
    {
        return $this->roomBookingRepository->pluckTrainingTitleBookingId();
    }

    public function updateStatus(RoomBooking $roomBooking, array $data)
    {
        return $this->update($roomBooking, $data);
    }

    public function forwardBookingRequest(RoomBooking $roomBooking, array $data)
    {
        return $this->bookingRequesteForwardRepository->getModel()->updateOrCreate(
            ['room_booking_id' => $roomBooking->id],
            [
                'forwarded_to' => $data['forwardTo'],
                'forwarded_by' => Auth::user()->id,
                'comment' => $data['comment']
            ]
        );
    }

    public function getBookingRequestWithInIds(array $searchCriteria = [], array $ids = [])
    {
        $ids = $ids ?: $this->getBookingRequestIdsWithForwardedByBookingTypes($searchCriteria);
        return $this->actionRepository->getModel()->whereIn('id', $ids)->orderBy('created_at', 'DESC')->get();
    }

    public function getBookingRequestIdsWithForwardedByBookingTypes(array $searchCriteria)
    {
        $bookingRequestIds = $this->actionRepository->getModel()->where('type', 'booking')
            ->whereIn('booking_type', $searchCriteria)
            ->orderBy('created_at', 'desc')
            ->get()->pluck('id')->toArray();

        $forwardedBookingRequestIds = $this->bookingRequesteForwardRepository->getModel()
            ->where('forwarded_to', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()->pluck('room_booking_id')
            ->toArray();

        $forwardedBookingRequestIdsByUsers = $this->bookingRequesteForwardRepository->getModel()
            ->where('forwarded_by', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()->pluck('room_booking_id')->toArray();

        return array_diff(
            array_merge($bookingRequestIds, $forwardedBookingRequestIds),
            $forwardedBookingRequestIdsByUsers
        );
    }

    /**
     * @param $approvedBookingCheckinRecords
     * @return \Illuminate\Support\Collection
     */
    private function getBookedRooms(Collection $approvedBookingCheckinRecords): \Illuminate\Support\Collection
    {
        $collectionOfBookedRooms = collect();
        $approvedBookingCheckinRecords->each(function ($booking) use ($collectionOfBookedRooms) {
            if ($booking->type == 'checkin') {
                $booking->rooms->each(function ($checkedinRoom) use ($collectionOfBookedRooms) {
                    $collectionOfBookedRooms->push([
                        'room_type_id' => $checkedinRoom->room->room_type_id,
                        'quantity' => 1
                    ]);
                });
            } else {
                $booking->roomInfos->each(function ($roomInfo) use ($collectionOfBookedRooms) {
                    $collectionOfBookedRooms->push([
                        'room_type_id' => $roomInfo->room_type_id,
                        'quantity' => $roomInfo->quantity
                    ]);
                });
            }
        });
        return $collectionOfBookedRooms;
    }

    /**
     * @return mixed
     */
    private function getTotalRoomsByRoomType()
    {
        $roomTypes = $this->roomTypeService->findAll();

        $totalRoomsByRoomType = [];

        $roomTypes->each(function ($roomType) use (&$totalRoomsByRoomType) {
            $totalRoomsByRoomType[$roomType->id] = $roomType->rooms->count();
        });

        return $totalRoomsByRoomType;
    }

    /**
     * @param RoomBooking $roomBooking
     * @return bool
     */
    private function checkRoomsAvailability(RoomBooking $roomBooking): bool
    {
        $approvedBookingCheckinRecords = $this->roomBookingRepository->getApprovedBookingCheckinRecords($roomBooking);

        $collectionOfBookedRooms = $this->getBookedRooms($approvedBookingCheckinRecords);

        $sumOfBookedRoomTypes = $collectionOfBookedRooms->groupBy('room_type_id')->map(function ($roomInfos) {
            return $roomInfos->sum('quantity');
        });
        $totalRoomsByRoomType = $this->getTotalRoomsByRoomType();

        $requestedRoomsByRoomTypes = $roomBooking->roomInfos->groupBy('room_type_id')->map(function ($roomInfos) {
            return $roomInfos->sum('quantity');
        });

        foreach ($requestedRoomsByRoomTypes as $roomTypeId => $roomQuantities) {
            $availableRooms = $this->getAvailableRooms($roomTypeId, $sumOfBookedRoomTypes, $totalRoomsByRoomType);

            if ($roomQuantities > $availableRooms) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param RoomBooking $roomBooking
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function approveBookingRequest(RoomBooking $roomBooking, array $data)
    {
        $roomBooking->physical_facility_request_id != null ?
            $this->vendorConfirmation($roomBooking) : '';

        if ($this->checkRoomsAvailability($roomBooking)) {
            return $this->update($roomBooking, $data);
        }
        return false;
    }


    private function vendorConfirmation($roomBooking)
    {
        $data['unique_key'] = str_random(32);
        $data['last_validity'] = Carbon::today()->addDay(7);
        $data['physical_facility_request_id'] = $roomBooking['physical_facility_request_id'];

        BookingVendorConfirmation::create($data);
    }

    /**
     * @param $roomTypeId
     * @param $sumOfBookedRoomTypes
     * @param $totalRoomsByRoomType
     * @return mixed
     */
    private function getAvailableRooms($roomTypeId, $sumOfBookedRoomTypes, $totalRoomsByRoomType)
    {
        if (array_key_exists($roomTypeId, $sumOfBookedRoomTypes->toArray()) &&
            array_key_exists($roomTypeId, $totalRoomsByRoomType)) {
            $availableRooms = $totalRoomsByRoomType[$roomTypeId] - $sumOfBookedRoomTypes[$roomTypeId];
        } else {
            $availableRooms = $totalRoomsByRoomType[$roomTypeId];
        }
        return $availableRooms;
    }

    /**
     * @param $data
     * @return array
     */
    private function storeRequesterFiles($data): array
    {
        $photoPath = array_key_exists('photo', $data) ? $this->upload($data['photo'], 'booking-requests') : null;
        $nidDocPath = array_key_exists('nid_doc', $data) ? $this->upload($data['nid_doc'], 'booking-requests') : null;
        $passportDocPath = array_key_exists('passport_doc', $data) ? $this->upload($data['passport_doc'],
            'booking-requests') : null;

        return array($photoPath, $nidDocPath, $passportDocPath);
    }

    /**
     * @param $guest
     * @return null
     */
    private function pullGuestNidDoc($guest)
    {
        $guest = isset($guest['id']) ? BookingGuestInfo::findOrFail($guest['id']) : null;

        return !is_null($guest) ? $guest->nid_doc : null;
    }

    /**
     * @param $data
     * @return null
     */
    private function pullOldRoomBooking($data)
    {
        return isset($data['booking_id']) ? RoomBooking::findOrfail($data['booking_id']) : null;
    }

    /**
     * @param $data
     * @param $keys
     * @return array
     */
    private function removableAttachments($data, $keys): array
    {
        $removableAttachments = [];

        foreach ($keys as $key) {
            array_key_exists($key, $data) ? $removableAttachments[] = $key : false;
        }

        return $removableAttachments;
    }

    /**
     * @param $data
     * @param RoomBooking $roomBooking
     * @return array
     */
    private function replaceRequesterInfo($data, RoomBooking $roomBooking)
    {
        $results = [];

        foreach ($data as $key => $value) {

            $results[] = ($value == null ? $roomBooking->requester->$key : $value);
        }

        return $results;

    }

    /**
     * @param $file
     * @param $path
     * @return \App\Traits\file
     */
    private function uploadGuestNidDoc($file, $path)
    {
        return $this->upload($file, $path);
    }

    /**
     * @param RoomBooking $roomBooking
     * @param null $attribute
     * @return bool
     */
    private function hasOldFile($roomBooking = null, $attribute = null): bool
    {
        return (!is_null($roomBooking)
            && !is_null($roomBooking->requester->$attribute));
    }

    private function prepareRequesterOrgType($data = [])
    {
        if (isset($data['organization_purpose']) && $data['organization_type'] == "government") {
            return $data['organization_type'] . '_' . $data['organization_purpose'];
        }
        return $data['organization_type'];
    }

    /**
     * @param $bookingGuestInfo
     * @param $status
     */
    public function changeStatusOfBookingGuestInfo($bookingGuestInfo, $status)
    {
        $this->bookingGuestInfoRepository->changeStatusOfGuest($bookingGuestInfo, $status);
    }

    public function getEditLink(RoomBooking $roomBooking)
    {
        $bookingTypes = RoomBooking::getBookingTypes();
        $editLink = route('booking-requests.edit', $roomBooking->id);
        if ($roomBooking->booking_type == $bookingTypes['training']) {
            $editLink = route('tms.hostel-booking-requests.edit', $roomBooking->id);
        }
        return $editLink;
    }

    public function getBookingRequestOfDateRange(Carbon $startDate, Carbon $endDate)
    {
        return $this->actionRepository->getBookingRequestOfDateRange($startDate, $endDate);

    }

    public function isAnyGuestAssignedRoom(RoomBooking $roomBooking, $CheckIfAllGuestAssignedToRoom = false)
    {
        $guestAssigned = false;

        if ($roomBooking->type != 'checkin') {
            return $guestAssigned;
        }
        if (!$CheckIfAllGuestAssignedToRoom) {
            foreach ($roomBooking->guestInfos as $guestInfo) {
                if ($guestInfo->checkinDetail) {
                    $guestAssigned = true;
                }
            }
        } else {
            // check if every guest is assigned to a room or not
            $guestAssigned = true;
            foreach ($roomBooking->guestInfos as $guestInfo) {
                if (!$guestInfo->checkinDetail) {
                    $guestAssigned = false;
                }
            }
        }
        if (!$guestAssigned) {
            // if no guest is assigned, the room status is still unavailable
            // so making it availble, and asking the user to create another check in
            // as we dont have any menu for assigning guest into the rooms
            foreach ($roomBooking->rooms as $bookedRoom) {
                $bookedRoom->room()->update(['status' => 'available']);
            }
            // set session error message
            \Illuminate\Support\Facades\Session::flash('error',
                trans('hm::booking-request.flash_messages.guest_not_assigned'));
        }
        return $guestAssigned;
    }

}

