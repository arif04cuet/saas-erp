<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\VMS\Entities\VehicleFillingStation;
use Modules\VMS\Http\Requests\VehicleFuelLogRequests;
use Modules\VMS\Services\VehicleFillingStationService;
use Modules\VMS\Services\VehicleTypeService;
use Modules\VMS\Services\VehicleService;
use Modules\VMS\Services\VehicleFuelLogService;
use Carbon\Carbon;
use Validator;

class VehicleFuelLogController extends Controller
{
    /**
     * @var $vehicleFillingStationService
     * @var $vehicleTypeService
     * @var VehicleService
     * @var VehicleFuelLogService
     */
    private $vehicleService;
    private $vehicleFillingStationService;
    private $vehicleTypeService;
    private $vehicleFuelLogService;

    /**
     * @param VehicleFillingStationService $vehicleFillingStationService
     * @param VehicleTypeService $vehicleTypeService
     * @param VehicleService $vehicleService
     * @param VehicleFuelLogService $vehicleFuelLogService
     */

    public function __construct(
        VehicleFillingStationService $vehicleFillingStationService,
        VehicleTypeService $vehicleTypeService,
        VehicleService $vehicleService,
        VehicleFuelLogService $vehicleFuelLogService
    )
    {
        $this->vehicleFillingStationService = $vehicleFillingStationService;
        $this->vehicleTypeService = $vehicleTypeService;
        $this->vehicleService = $vehicleService;
        $this->vehicleFuelLogService = $vehicleFuelLogService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $fuelLog = $this->vehicleFuelLogService->findAll();
        return view('vms::fuelLogBook.index', compact('fuelLog'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        $page = "create";
        $vehicleTypes = $this->vehicleTypeService->getVehicleTypesForDropdown();
        $fuelTypes = $this->vehicleService->getFuelTypesForDropdown();
        $vehicle = $this->vehicleFuelLogService->getVehiclesForDropdown();
        $fillingStation = $this->vehicleFillingStationService->getFillingStationForDropdown();
        return view('vms::fuelLogBook.create', compact('page', 'vehicleTypes', 'fuelTypes', 'vehicle', 'fillingStation'));
    }

    /**
     * @param VehicleFuelLogRequests $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VehicleFuelLogRequests $request)
    {
        $inputData = $request->all();
        $inputData['date'] = Carbon::parse($inputData['date'])->format('Y-m-d');
        $this->vehicleFuelLogService->save($inputData);
        return redirect()->route('vms.fuel.log.index')->with('success', __('labels.save_success'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function show($id)
    {
        $fuelLog = $this->vehicleFuelLogService->findOne($id);
        return view('vms::fuelLogBook.show', compact('fuelLog'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $fuelLog = $this->vehicleFuelLogService->findOne($id);
        $page = "edit";
        $vehicleTypes = $this->vehicleTypeService->getVehicleTypesForDropdown();
        $fuelTypes = $this->vehicleService->getFuelTypesForDropdown();
        $vehicle = $this->vehicleFuelLogService->getVehiclesForDropdown();
        $fillingStation = $this->vehicleFillingStationService->getFillingStationForDropdown();
        return view('vms::fuelLogBook.create', compact('fuelLog', 'page', 'vehicleTypes', 'fuelTypes', 'vehicle', 'fillingStation'));

    }

    /**
     * Update the specified resource in storage.
     * @param VehicleFuelLogRequests $request
     * @param int $id
     * @return Response
     */
    public function update(VehicleFuelLogRequests $request, $id)
    {
        $inputData = $request->all();
        $inputData['date'] = Carbon::parse($inputData['date'])->format('Y-m-d');
        $this->vehicleFuelLogService->findOrFail($id)->update($inputData);

        return redirect()->route('vms.fuel.log.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $vehicleFillingStation
     * @param $id
     * @return Response
     */
    public function destroy(VehicleFillingStation $vehicleFillingStation, $id)
    {
//        $checkMedicineAllReadyUse = $this->vehicleFillingStationService->findBy(['id' => $id])->count();
//        if ($checkMedicineAllReadyUse < 1) {
//        $vehicleFillingStation->destroy($id);
        Session::flash('warning', trans('labels.delete_success'));
//        } else {
//            Session::flash('warning', trans('mms::medicine.already_in_use'));
//        }

        return redirect()->route('vms.fillingStation.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acknowledgement(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072'
        ]);
        if ($validation->passes()) {
            $image_name = $this->vehicleFuelLogService->acknowledgementFiles($data);
            if ($image_name == true) {
                return redirect()->route('vms.fuel.log.index')->with('success', __('labels.update_success'));
            } else {
                return redirect()->route('vms.fuel.log.index')->with('warning', __('labels.save_fail'));
            }
        } else {
            return redirect()->route('vms.fuel.log.index')->with('warning', __('labels.save_fail'));

        }

    }

    public function fuelReport()
    {
        $page = "create";
        $fillingStation = $this->vehicleFillingStationService->getFillingStationForDropdown();
        return view('vms::fuelLogBook.report.report', compact('page', 'fillingStation'));

    }

    public function data(Request $request)
    {
        $input = $request->all();
        $fillingStationID = $input['filling_station_id'];
        $date = $name = explode(' - ', $input['date']);
        $startDate = $date[0];
        $endDate = $date[1];
        $draw = $_POST['draw'];
        $data = array();
        $start = $input['start'] ?? 0;
        $limit = $input['length'] ?? 10;
        if ($input['filling_station_id'][0] !== 'ALL') {
            $filling_stationIds = $fillingStationID;
        } else {
            $filling_stationIds = $this->vehicleFuelLogService->getFillingStationIds();
        }
        if ($limit == -1) {
            $limit = $this->vehicleFuelLogService->findAll()
                ->whereIN('filling_station_id', $filling_stationIds)
                ->whereBetween('date', [$startDate, $endDate])->count();
        }
        $fuelLog = $this->vehicleFuelLogService->findAll($limit, null, null)
            ->whereIN('filling_station_id', $filling_stationIds)
            ->whereBetween('date', [$startDate, $endDate]);
        foreach ($fuelLog as $key => $info) {
            $data[] = array(
                "sl" => $key + 1,
                "vehicle_name" => $info->vehicle->name ?? trans('labels.not_found'),
                "vehicle_type" => $info->vehicleType->getTitle() ?? trans('labels.not_found'),
                "fuel_type" => trans("vms::fuelLogBook.fuel_type." . $info->fuel_type),
                "fuel_quantity" => $info->fuel_quantity ?? trans('labels.not_found'),
                "filling_station_name" => $info->fillingStation->name ?? trans('labels.not_found'),
                "amount" => $info->amount ?? trans('labels.not_found'),
                "status" => trans("vms::fuelLogBook.status.$info->status"),
                "date" => date('d M Y', strtotime($info->date))
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => count($fuelLog),
            "iTotalDisplayRecords" => $limit,
            "aaData" => $data
        );

        echo json_encode($response);
    }
}
