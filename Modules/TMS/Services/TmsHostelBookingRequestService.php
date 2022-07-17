<?php

namespace Modules\TMS\Services;

use App\Services\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Entities\RoomBookingRequester;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\RoomTypeService;
use Modules\TMS\Entities\Training;

class TmsHostelBookingRequestService
{
    /**
     * @var TrainingsService
     */
    private $trainingService;
    /**
     * @var RoomTypeService
     */
    private $roomTypeService;
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * TmsHostelBookingRequestService constructor.
     * @param TrainingsService $trainingsService
     * @param RoomTypeService $roomTypeService
     * @param UserService $userService
     * @param BookingRequestService $bookingRequestService
     */
    public function __construct(
        TrainingsService $trainingsService,
        RoomTypeService $roomTypeService,
        UserService $userService,
        BookingRequestService $bookingRequestService
    ) {
        $this->trainingService = $trainingsService;
        $this->roomTypeService = $roomTypeService;
        $this->userService = $userService;
        $this->bookingRequestService = $bookingRequestService;
    }

    public function getTrainingsForDropdown()
    {
        return $this->trainingService->findAll()->pluck('title', 'id');
    }

    public function getRoomTypesForDropdown()
    {
        return $this->roomTypeService->getRoomTypesForDropdown();
    }

    public function getTrainingInformations()
    {
        $trainings = $this->trainingService->findAll()->keyBy('id');
        return $trainings->each(function ($t) {
            $t->total_registered_trainees = $this->trainingService->getTotelRegistaredTrainee($t);
            return $t;
        });
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data): bool
    {
        try {
            DB::beginTransaction();
            //save room booking data
            $roomBookingData = $this->prepareRoomBookingData($data);
            $roomBooking = $this->bookingRequestService->save($roomBookingData);
            //save organization data
            $requesterInformation = $this->prepareRequesterData($data['training_id']);
            $roomBooking->requester()->save(new RoomBookingRequester($requesterInformation));
            //save room infos data
            $roomInformationData = $this->prepareRoomInformationData($data['tms_hostel_booking_request']);
            $this->bookingRequestService->saveRoomInfos($roomBooking, $roomInformationData);
            //safe to commit
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', $e->getMessage());
            Log::error("TmsHostelBookingError: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function update(array $requestData)
    {
        try {
            DB::beginTransaction();
            // clear previous room information
            $roomBooking = $this->bookingRequestService->findOne($requestData['room_booking_id']);
            $this->clearPreviousRoomInformation($roomBooking);
            //update room booking data
            $roomBookingData = $this->prepareRoomBookingData($requestData);
            $roomBooking = $this->bookingRequestService->update($roomBooking, $roomBookingData);
            //save room infos data
            $roomInformationData = $this->prepareRoomInformationData($requestData['tms_hostel_booking_request']);
            $this->bookingRequestService->saveRoomInfos($roomBooking, $roomInformationData);
            //safe to commit
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("TmsHostelBooking-Update-Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }

    }

    /**
     * @param $roomBookingId
     * @return Collection
     */
    public function getOldTmsHostelBookingRequestInformation($roomBookingId)
    {
        $data = collect();
        $roomBooking = $this->bookingRequestService->findOne($roomBookingId);
        $training = $roomBooking->training;
        $data['training_id'] = $training->id;
        $data['no_of_trainee'] = $training->no_of_trainee;
        $data['start_date'] = $roomBooking->start_date;
        $data['end_date'] = $roomBooking->end_date;
        $data['tms_hostel_booking_request'] = $roomBooking->roomInfos;
        return $data;
    }

    /**
     * @param $oldResponses
     */
    public function setOldValuesToSession($oldResponses)
    {
        session(['_old_input.training_id' => $oldResponses['training_id']]);
        session(['_old_input.no_of_trainee' => $oldResponses['no_of_trainee']]);
        session(['_old_input.start_date' => $oldResponses['start_date']]);
        session(['_old_input.end_date' => $oldResponses['end_date']]);
        session(['_old_input.tms_hostel_booking_request' => $oldResponses['tms_hostel_booking_request']]);
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.training_id')) {
            session()->forget('_old_input.training_id');
        }
        if (session()->has('_old_input.no_of_trainee')) {
            session()->forget('_old_input.no_of_trainee');
        }
        if (session()->has('_old_input.start_date')) {
            session()->forget('_old_input.start_date');
        }
        if (session()->has('_old_input.end_date')) {
            session()->forget('_old_input.end_date');
        }
        if (session()->has('_old_input.tms_hostel_booking_request')) {
            session()->forget('_old_input.tms_hostel_booking_request');
        }

    }

    //--------------------------------------------------------------------
    //                         Private methods
    //--------------------------------------------------------------------

    /**
     * @param array $data
     * @return array
     */
    private function prepareRoomBookingData(array $data)
    {
        return [
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'shortcode' => time(),
            'booking_type' => config('constants.booking_types.training'),
            'type' => 'booking',
            'status' => config('constants.room_booking_status.pending'),
            'training_id' => $data['training_id']
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepareRoomInformationData(array $data): array
    {
        $roomInformation = [];
        $totalRooms = [];
        foreach ($data as $rooms) {
            $eachRoom = [];
            $eachRoom['room_type_id'] = $rooms['room_type_id'];
            $eachRoom['quantity'] = $rooms['quantity'];
            $totalRooms[] = $eachRoom;
        }
        $roomInformation['roomInfos'] = $totalRooms;
        $roomInformation['organization_type'] = 'others';
        return $roomInformation;
    }

    /**
     * @param $trainingId
     * @return array
     * @throws Exception
     */
    private function prepareRequesterData($trainingId): array
    {
        // the requester data should be the course director of a training (BEP-765)

        $training = Training::find($trainingId);
        $courseDirector = $training->administrations()->whereRole('course_director')->first();
        $courseDirectorEmployee = optional($courseDirector)->employee ?? null;
        if (is_null($courseDirector) || is_null($courseDirectorEmployee)) {
            throw new Exception('Please Select A Course Director For This Training First !');
        }
        $firstName = $courseDirectorEmployee->first_name ?? trans('labels.not_found');
        $lastName = $courseDirectorEmployee->last_name ?? trans('labels.not_found');
        $requesterEmail = $courseDirectorEmployee->email ?? '';
        $requesterContact = $courseDirectorEmployee->mobile_one ?? '';
        $organizationName = 'BARD (Cumilla)';
        $organizationType = 'bard';
        //get training organization
        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'contact' => $requesterContact,
            'email' => $requesterEmail,
            'organization' => $organizationName,
            'organization_type' => $organizationType,
        ];

    }

    /**
     * @param $name
     * @return array
     */
    private function getFirstAndLastNames($name): array
    {
        $values = explode(' ', $name, 2);
        $data[0] = $values[0] ?? trans('labels.not_found');
        $data[1] = $values[1] ?? '';
        return $data;
    }

    /**
     * Delete Room Information of a booking request
     * @param RoomBooking $roomBooking
     * @return mixed
     */
    private function clearPreviousRoomInformation(RoomBooking $roomBooking)
    {
        return $roomBooking->roomInfos()->delete();
    }


}

