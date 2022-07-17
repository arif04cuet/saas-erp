<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Modules\HM\Emails\BookingRequestMail;
use Modules\HM\Entities\BookingCheckin;
use Modules\HM\Entities\BookingGuestInfo;
use Modules\HM\Entities\CheckinTrainee;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Entities\RoomBookingRequester;
use Modules\HM\Repositories\BookingGuestInfoRepository;
use Modules\HM\Repositories\CheckInApprovedTrainingRepository;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TraineeService;

class CheckInApprovedTrainingService
{
    use CrudTrait;

    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;
    /**
     * @var TraineeService
     */
    private $traineeService;

    /**
     * @var CheckinService
     */
    private $checkInService;

    /**
     * @var CheckinTraineeService
     */
    private $checkinTraineeService;

    /**
     * CheckInApprovedTrainingService constructor.
     * @param CheckInApprovedTrainingRepository $checkInApprovedTrainingRepository
     * @param TraineeService $traineeService
     * @param CheckinService $checkInService
     * @param CheckinTraineeService $checkinTraineeService
     * @param BookingRequestService $bookingRequestService
     */
    public function __construct(
        CheckInApprovedTrainingRepository $checkInApprovedTrainingRepository,
        TraineeService $traineeService,
        CheckinService $checkInService,
        CheckinTraineeService $checkinTraineeService,
        BookingRequestService $bookingRequestService
    ) {
        $this->setActionRepository($checkInApprovedTrainingRepository);
        $this->bookingRequestService = $bookingRequestService;
        $this->traineeService = $traineeService;
        $this->checkinTraineeService = $checkinTraineeService;
        $this->checkInService = $checkInService;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $oldRoomBooking = $this->findOne($data['room_booking_id']);
            $newRoomBooking = null;
            // create another row in booking request
            if ($data['room_booking_id']) {
                $newRoomBooking = $this->createNewRoomBookingForCheckin($oldRoomBooking);
            }
            //save requester information
            $requester = $this->saveRoomBookingRequesterInformation(
                $oldRoomBooking, $newRoomBooking
            );
            //save room information
            $this->saveRoomInformation($newRoomBooking, $data['assign']);
            // save checkin mapper
            BookingCheckin::create(['checkin_id' => $newRoomBooking->id, 'booking_id' => $oldRoomBooking->id]);
            // save checkin room numbers
            $this->saveRoomNumbersOfCheckIn($newRoomBooking, $data['assign']);
            //save trainee as guest
            $this->saveTraineeAsGuest(
                $newRoomBooking, $data['training_id'], $data['assign']
            );

            // todo:: un-comment these lines for email notification
            // notify requester
            //$this->sendEmail($requester->email, $newRoomBooking);
            // notify directoradmin
            //$this->sendEmail('kamrul_61@yahoo.com', $newRoomBooking);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Checkin Trainee Error" . $e->getMessage() . " trace:" . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param $roomBooking
     * @param array $data -
     */
    public function saveRoomInformation($roomBooking, array $data)
    {
        $roomInformation = $this->prepareDataForRoomInformation($data);
        $this->bookingRequestService->saveRoomInfos($roomBooking, $roomInformation);
    }

    /**
     * @param RoomBooking $oldRoomBooking
     * @param RoomBooking $newRoomBooking
     * @return RoomBookingRequester
     */
    public function saveRoomBookingRequesterInformation(
        RoomBooking $oldRoomBooking,
        RoomBooking $newRoomBooking
    ): RoomBookingRequester {

        $oldBookingRequester = RoomBookingRequester::where('room_booking_id', $oldRoomBooking->id)->first();
        $newBookingRequester = $oldBookingRequester->replicate();
        $newBookingRequester['room_booking_id'] = $newRoomBooking->id;
        $newBookingRequester->save();
        return $newBookingRequester;
    }

    /**
     * @param RoomBooking $roomBooking
     * @param $trainingId
     * @param array $data - specific format
     */
    public function saveTraineeAsGuest(RoomBooking $roomBooking, $trainingId, array $data)
    {
        foreach ($data as $rooms) {
            foreach ($rooms['room'] as $room) {
                // if the checkbox is on, read from the trainee array
                if (isset($room['is_trainee_registered'])) {
                    foreach ($room['trainees'] as $traineeId) {
                        $eachGuest = collect();

                        $eachGuest = $this->traineeService
                            ->prepareTraineeDataForHostelCheckIn($roomBooking->id, $trainingId, $traineeId);

                        $guest = BookingGuestInfo::create($eachGuest);

                        $this->saveCheckInDetails($roomBooking->id, $room['room_numbers'],
                            $guest->id);

                        $this->checkinTraineeService->save([
                            'training_id' => $trainingId,
                            'trainee_id' => $traineeId,
                            'checkin_id' => $roomBooking->id,
                            'booking_guest_info_id' => $guest->id
                        ]);
                    }
                } else {
                    $name = $room['name'] ?? trans('hm::booking-request.not_given');

                    $mobileNumber = $room['mobile_number'] ?? trans('hm::booking-request.not_given');

                    $eachGuest = $this->checkInService->prepareHostelCheckinDataWithMinimumInfo($roomBooking,
                        ['name' => $name, 'mobile_number' => $mobileNumber]);

                    $guest = BookingGuestInfo::create($eachGuest);

                    $this->saveCheckInDetails($roomBooking->id, $room['room_numbers'],
                        $guest->id);

                    $this->checkinTraineeService->save([
                        'training_id' => $trainingId,
                        'trainee_id' => null,
                        'checkin_id' => $roomBooking->id,
                        'booking_guest_info_id' => $guest->id
                    ]);
                }
            }
        }

    }

    /**
     * @param array $data [ { 'room_type_id'=> 4,'room'=>[] }, .... ]
     * @return array
     */
    public function prepareDataForRoomInformation(array $data): array
    {
        $roomInformation = [];
        $totalRooms = [];
        foreach ($data as $rooms) {
            $eachRoom = [];
            $eachRoom['room_type_id'] = $rooms['room_type_id'];
            $eachRoom['quantity'] = 0;
            foreach ($rooms['room'] as $room) {
                $eachRoom['quantity']++;
            }
            $totalRooms[] = $eachRoom;
        }
        $roomInformation['roomInfos'] = $totalRooms;
        $roomInformation['organization_type'] = 'others';
        return $roomInformation;
    }

    /**
     * @param RoomBooking $roomBooking
     * @param array $data - [{ 'room_type_id', [ 'room'=>[ {'room_numbers','trainee'=>[...] } ] },.... ]]
     */
    public function saveRoomNumbersOfCheckIn(RoomBooking $roomBooking, array $data)
    {
        $roomNumbers = [];
        foreach ($data as $rooms) {
            foreach ($rooms['room'] as $room) {
                $roomNumbers[] = $room['room_numbers'];
            }
        }
        $roomNumberAsString = implode(',', $roomNumbers);
        $this->bookingRequestService->saveRoomNumbers($roomBooking, $roomNumberAsString);
    }

    /**
     * @param Model|null $oldRoomBooking
     * @return Model
     */
    public function createNewRoomBookingForCheckin(?Model $oldRoomBooking): Model
    {
        $newRoomBooking = $oldRoomBooking->replicate();
        $newRoomBooking->start_date = Carbon::now()->format('Y-m-d');
        $newRoomBooking->shortcode = time();
        $newRoomBooking->type = 'checkin';
        $newRoomBooking = $this->save($newRoomBooking->toArray());
        return $newRoomBooking;
    }

    /**
     * @param $email
     * @param RoomBooking $roomBooking
     */
    private function sendEmail($email, RoomBooking $roomBooking)
    {
        Mail::to($email)->send(new BookingRequestMail($roomBooking));
    }

    /**
     * @param $roomBookingId
     * @param $roomId
     * @param $guestId
     * @return Model
     */

    public function saveCheckInDetails($roomBookingId, $roomId, $guestId)
    {
        $this->checkInService->storeCheckInDetailsOfGuest(
            $roomBookingId,
            $guestId,
            $roomId
        );
        $this->bookingRequestService
            ->changeStatusOfBookingGuestInfo($guestId, 'checkin');

    }

    /**
     * Get a view of booking information and training information
     * If used in blade file via controller, render() it
     * If Used in Ajax call, set to html()
     * @param RoomBooking $roomBooking
     * @param Training $training
     * @return Factory|View
     */
    public function getDynamicContent(RoomBooking $roomBooking, Training $training)
    {
        return view('hm::check-in.approved-training.helper.dynamic-content', compact('roomBooking', 'training'));
    }

    /**
     * @param Training $training
     * @return array - in dropdown format [key]=>[value] pair
     */
    public function filterTraineeByHostelCheckInForDropDown(Training $training)
    {
        $trainees = $this->traineeService
            ->filterTraineesByHostelCheckIn($training);
        return $this->traineeService->getTraineesForDropdown($trainees);
    }
}

