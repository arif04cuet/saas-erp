<?php

namespace App\Services;

use App\Repositories\Remark\PhysicalFacilityRequestRepository;
use App\Repositories\Remark\RequestedFacilityRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\HM\Services\BookingRequestService;

class PhysicalFacilityRequestService
{
    use CrudTrait;
    /**
     * @var PhysicalFacilityRequestRepository
     */
    private $physicalFacilityRequestRepository;
    /**
     * @var RequestedFacilityRepository
     */
    private $requestedFacilityRepository;
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;

    /**
     * PhysicalFacilityRequestService constructor.
     * @param PhysicalFacilityRequestRepository $physicalFacilityRequestRepository
     * @param RequestedFacilityRepository $requestedFacilityRepository
     * @param BookingRequestService $bookingRequestService
     */
    public function __construct(
        PhysicalFacilityRequestRepository $physicalFacilityRequestRepository,
        RequestedFacilityRepository $requestedFacilityRepository,
        BookingRequestService $bookingRequestService
    ) {
        $this->physicalFacilityRequestRepository = $physicalFacilityRequestRepository;
        $this->setActionRepository($physicalFacilityRequestRepository);
        $this->requestedFacilityRepository = $requestedFacilityRepository;
        $this->bookingRequestService = $bookingRequestService;
    }

    /**
     * Method to store physical facility request and create booking request as well
     * @param array $data
     * @return bool|mixed
     */
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $saveRequest = $this->save($data);

            // Creating booking request
            $bookingData = $this->prepareBookingRequestData($data);
            $bookingData['physical_facility_request_id'] = $saveRequest->id;
            $saveBooking = $this->bookingRequestService->store($bookingData);

            //dd($data, $saveRequest, $saveBooking);
            // TODO: fetch facility type dynamically
            $facilityData = [
                'physical_facility_request_id' => $saveRequest->id,
                'facility_type' => config('constants.facility_types.hostel'),
                'reference_table_id' => $saveBooking->id,
                'book_from' => Carbon::parse($data['start_date'])->format('Y-m-d'),
                'book_to' => Carbon::parse($data['end_date'])->format('Y-m-d'),
            ];
            $saveFacility = $this->requestedFacilityRepository->save($facilityData);
        });
        try {
            Session::flash('success', __('labels.save_success'));
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.save_fail') . ', ' . __('labels.error_code',
                                                                       ['code' => $exception->getCode()]));
        }
    }

    private function prepareBookingRequestData(array $data)
    {
        $preparedData = $data;
        $nameArr = explode(' ', $data['requester_name']);
        $preparedData['first_name'] = $nameArr[0];
        $preparedData['middle_name'] = !empty($nameArr[2])? $nameArr[1] : null;
        $preparedData['last_name'] = !empty($nameArr[2])? $nameArr[2] : $nameArr[1] ?? '';
        $preparedData['contact'] = $data['mobile_no'];
        $preparedData['address'] = $data['organization'];
        $preparedData['gender'] = 'male';
        $preparedData['organization_type'] = 'non_government';
        $preparedData['booking_type'] = config('constants.booking_types.physical_facility');
        $preparedData['guests'] = [[
            "first_name" => $preparedData['first_name'],
            "middle_name" => null,
            "last_name" => $preparedData['last_name'],
            "age" => 0,
            "nationality" => "Bangladeshi",
            "gender" => "male",
            "relation" => "myself",
            "nid_no" => null,
            "address" => ""
        ]];
        $preparedData['nid'] = null;
        $preparedData['passport_no'] = null;
        $preparedData['designation'] = null;
        $preparedData['org_address'] = null;
        $preparedData['employee_id'] = null;
        $preparedData['comment'] = null;

        return $preparedData;
    }
}
