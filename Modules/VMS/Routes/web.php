<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'can:guest_access'])->prefix('vms')->group(function () {

    Route::get('/', 'VMSController@index')->name('vms');

//    // vehicle routes
//    Route::prefix('vehicle')->group(function () {
//        Route::get('/', function () {
//            return view('vms::vehicles.index');
//        })->name('vehicles.index');
//
//        Route::get('/create', function () {
//            return view('vms::vehicles.create');
//        })->name('vehicles.create');
//        Route::get('/show', function () {
//            return view('vms::vehicles.show');
//        })->name('vehicles.show');
//        Route::get('/edit', function () {
//            return view('vms::vehicles.edit');
//        })->name('vehicles.edit');
//        Route::get('/driver-assign', function () {
//            return view('vms::vehicles.driver-assign');
//        })->name('driver.assign');
//        Route::get('/request', function () {
//            return view('vms::vehicles.request');
//        })->name('request');
//        Route::get('/request-list', function () {
//            return view('vms::vehicles.request-list');
//        })->name('request.list');
//        Route::get('/request-details', function () {
//            return view('vms::vehicles.request-details');
//        })->name('request.details');
//        Route::get('/vehicles-bill', function () {
//            return view('vms::vehicles.bill');
//        })->name('bill');
//    });
    // Vehicle related routes
    Route::prefix('vehicles')->group(function () {
        Route::get('/', 'VehicleController@index')->name('vms.vehicles.index');
        Route::get('/create', 'VehicleController@create')->name('vms.vehicles.create');
        Route::post('/', 'VehicleController@store')->name('vms.vehicles.store');
        Route::put('/{vehicle}', 'VehicleController@update')->name('vms.vehicles.update');
        Route::get('/{vehicle}', 'VehicleController@show')->name('vms.vehicles.show');
        Route::get('/{vehicle}/status/{status}', 'VehicleController@changeStatus')->name('vms.vehicles.change-status');
        Route::get('/{vehicle}/edit', 'VehicleController@edit')->name('vms.vehicles.edit');

        Route::prefix('/driver-assign')->group(function () {
            Route::get('/create/{vehicle?}',
                'VehicleDriverAssignController@create')->name('vms.vehicles.driver-assign.create');
            Route::post('/',
                'VehicleDriverAssignController@store')->name('vms.vehicles.driver-assign.store');
            Route::get('/',
                'VehicleDriverAssignController@index')->name('vms.vehicles.driver-assign.index');
            Route::delete('/',
                'VehicleDriverAssignController@destroy')->name('vms.vehicles.driver-assign.destroy');
            Route::get('/vehicle-information/{vehicle}',
                'VehicleDriverAssignController@getVehicleInformation')->name('vms.vehicles.driver-assign.vehicle-information');
        });
    });
    // driver related routes
    Route::prefix('drivers')->group(function () {
        Route::get('/', 'DriverController@index')->name('vms.drivers.index');
        Route::get('/create', 'DriverController@create')->name('vms.drivers.create');
        Route::post('/', 'DriverController@store')->name('vms.drivers.store');
        Route::put('/{driver}', 'DriverController@update')->name('vms.drivers.update');
        Route::get('/{driver}', 'DriverController@show')->name('vms.drivers.show');
        Route::get('/{driver}/edit', 'DriverController@edit')->name('vms.drivers.edit');
    });
    // vehicle type
    Route::prefix('vehicle-types')->group(function () {
        Route::get('/', 'VehicleTypeController@index')->name('vms.vehicle-types.index');
        Route::get('/create', 'VehicleTypeController@create')->name('vms.vehicle-types.create');
        Route::post('/', 'VehicleTypeController@store')->name('vms.vehicle-types.store');
        Route::put('/{vehicleType}', 'VehicleTypeController@update')->name('vms.vehicle-types.update');
        Route::get('/{vehicleType}', 'VehicleTypeController@show')->name('vms.vehicle-types.show');
        Route::get('/{vehicleType}/edit', 'VehicleTypeController@edit')->name('vms.vehicle-types.edit');
    });
    // trip related routes
    Route::prefix('trip')->group(function () {
        Route::get('/{trip}/show', 'TripController@show')->name('vms.trip.show');
        Route::get('/{trip}/print', 'TripController@print')->name('vms.trip.print');
        Route::get('/', 'TripController@index')->name('vms.trip.index');
        Route::get('/{trip}/status/{status}', 'TripController@changeStatus')->name('vms.trip.change-status');
        Route::post('/', 'TripController@store')->name('vms.trip.store');
        Route::get('/create', 'TripController@create')->name('vms.trip.create');
        Route::get('/{trip}/edit', 'TripController@edit')->name('vms.trip.edit');
        Route::post('/load', 'TripController@load')->name('vms.trip.load');
        Route::put('/{trip}', 'TripController@update')->name('vms.trip.update');
        Route::put('/{trip}/update-ajax', 'TripController@updateViaAjax')->name('vms.trip.update-via-ajax');
        // vehicle allocation related
        Route::get('/{trip}/vehicle-allocate/{vehicle}',
            'TripController@allocateVehicle')
            ->name('vms.trip.allocate-vehicle');
        Route::get('/{trip}/vehicle-remove/{vehicle}', 'TripController@removeVehicle')
            ->name('vms.trip.remove-vehicle');

        // apply related
//        Route::get('/apply', 'TripController@apply')->name('vms.trip.apply');
//        Route::post('/apply/set-vehicle-session',
//            'TripController@setVehicleSession')->name('vms.trip.apply.set-vehicle-session');
//        Route::post('/apply', 'TripController@showAvailableVehicle')->name('vms.trip.show-available-vehicle');
//
        // feedback related
        Route::prefix('/feedback')->group(function () {
            Route::get('/{trip}/create', 'TripFeedbackController@create')->name('vms.trip.feedback.create');
            Route::post('/', 'TripFeedbackController@store')->name('vms.trip.feedback.store');
        });
        // Setting related
        Route::prefix('/setting')->group(function () {
            Route::get('/create', 'TripCalculationSettingController@create')->name('vms.trip.setting.create');
            Route::get('/', 'TripCalculationSettingController@index')->name('vms.trip.setting.index');
            Route::get('/{tripCalculationSetting}/edit',
                'TripCalculationSettingController@edit')->name('vms.trip.setting.edit');
            Route::put('/{tripCalculationSetting}',
                'TripCalculationSettingController@update')->name('vms.trip.setting.update');
            Route::post('/', 'TripCalculationSettingController@store')->name('vms.trip.setting.store');
        });

        // Limit related routes
        Route::prefix('/limit')->group(function () {
            Route::get('/create', 'TripLimitController@create')->name('vms.trip.limit.create');
            Route::get('/', 'TripLimitController@index')->name('vms.trip.limit.index');
            Route::get('/{tripLimit}/edit', 'TripLimitController@edit')->name('vms.trip.limit.edit');
            Route::put('/{tripLimit}', 'TripLimitController@update')->name('vms.trip.limit.update');
            Route::post('/', 'TripLimitController@store')->name('vms.trip.limit.store');
        });
        // workflow related
        Route::prefix('/workflow')->group(function () {
            Route::get('/{trip}', 'TripWorkflowController@show')->name('vms.trip.workflow.show');
        });
        //Bill related
        Route::prefix('/bill')->group(function () {
            Route::get('/', 'TripBillController@index')->name('vms.trip.bill.index');
            Route::get('/{trip}', 'TripBillController@show')->name('vms.trip.bill.show');
            Route::post('/{trip}/payment',
                'TripBillController@payment')->name('vms.trip.bill.payment');

        });
    });
    // Vehicle related routes
//    Route::prefix('vehicles')->group(function () {
//        Route::get('/create', 'VehicleController@create')->name('vms.vehicles.create');
//        Route::post('/', 'VehicleController@store')->name('vms.vehicles.store');
//        Route::put('/', 'VehicleController@update')->name('vms.vehicles.update');
//        Route::get('/{driverId}', 'VehicleController@show')->name('vms.vehicles.show');
//        Route::get('/{driverId}/edit', 'VehicleController@edit')->name('vms.vehicles.edit');
//    });
//

    // Bill related
    Route::prefix('/bill-sector')->group(function () {
        Route::get('/', 'VmsBillSectorController@index')->name('vms.bill-sector.index');
        Route::get('/create', 'VmsBillSectorController@create')->name('vms.bill-sector.create');
        Route::get('/{vmsBillSector}', 'VmsBillSectorController@show')->name('vms.bill-sector.show');
        Route::get('/{vmsBillSector}/edit', 'VmsBillSectorController@edit')->name('vms.bill-sector.edit');
        Route::post('/', 'VmsBillSectorController@store')->name('vms.bill-sector.store');
        Route::put('/{vmsBillSector}', 'VmsBillSectorController@update')->name('vms.bill-sector.update');
    });

    // Monthly Bill Submission Related
    Route::prefix('/monthly-bill')->group(function () {
        Route::get('/create', 'VmsMonthlyBillSubmissionController@create')->name('vms.monthly-bill.create');
        Route::post('/create', 'VmsMonthlyBillSubmissionController@store')->name('vms.monthly-bill.store');
        Route::post('/submit', 'VmsMonthlyBillSubmissionController@submit')->name('vms.monthly-bill.submit');
    });

    // filling Station related routes
    Route::prefix('filling-station')->group(function () {
        Route::get('/', 'VehicleFillingStationController@index')->name('vms.fillingStation.index');
        Route::get('/create', 'VehicleFillingStationController@create')->name('vms.fillingStation.create');
        Route::post('/store', 'VehicleFillingStationController@store')->name('vms.fillingStation.store');
        Route::put('/{id}', 'VehicleFillingStationController@update')->name('vms.fillingStation.update');
        Route::get('/{id}', 'VehicleFillingStationController@show')->name('vms.fillingStation.show');
        Route::get('/{id}/edit', 'VehicleFillingStationController@edit')->name('vms.fillingStation.edit');
        Route::delete('delete/{id}', 'VehicleFillingStationController@destroy')->name('vms.fillingStation.delete');
    });

    // fuel Log Book related routes
    Route::prefix('fuel-log')->group(function () {
        Route::get('/', 'VehicleFuelLogController@index')->name('vms.fuel.log.index');
        Route::get('/create', 'VehicleFuelLogController@create')->name('vms.fuel.log.create');
        Route::post('/store', 'VehicleFuelLogController@store')->name('vms.fuel.log.store');
        Route::put('/{id}', 'VehicleFuelLogController@update')->name('vms.fuel.log.update');
        Route::get('/fuel-report', 'VehicleFuelLogController@fuelReport')->name('vms.fuel.log.report');
        Route::POST('/fuel-report-data', 'VehicleFuelLogController@data')->name('vms.fuel.log.report.data');

        Route::get('/{id}', 'VehicleFuelLogController@show')->name('vms.fuel.log.show');
        Route::get('/{id}/edit', 'VehicleFuelLogController@edit')->name('vms.fuel.log.edit');

        Route::delete('delete/{id}', 'VehicleFuelLogController@destroy')->name('vms.fuel.log.delete');
        Route::POST('/acknowledgement', 'VehicleFuelLogController@acknowledgement')->name('fuel.log.acknowledgement');
    });

    // Vms Integration Related Settings
    Route::prefix('integration-setting')->group(function () {
        Route::get('/', 'VmsIntegrationSettingController@index')->name('vms.integration.setting.index');
        Route::get('/create', 'VmsIntegrationSettingController@create')->name('vms.integration.setting.create');
        Route::post('/store', 'VmsIntegrationSettingController@store')->name('vms.integration.setting.store');
        Route::put('/{vmsIntegrationSetting}',
            'VmsIntegrationSettingController@update')->name('vms.integration.setting.update');
        Route::get('/{vmsIntegrationSetting}',
            'VmsIntegrationSettingController@show')->name('vms.integration.setting.show');
        Route::get('/{vmsIntegrationSetting}/edit',
            'VmsIntegrationSettingController@edit')->name('vms.integration.setting.edit');
        Route::delete('{vmsIntegrationSetting}/delete',
            'VmsIntegrationSettingController@destroy')->name('vms.integration.setting.delete');
    });

    // fuel Bill submit related routes
    Route::prefix('fuel-bill-submit')->group(function () {
        Route::get('/', 'VehicleFuelBillSubmitController@index')->name('vms.fuel.bill.index');
        Route::get('/create', 'VehicleFuelBillSubmitController@create')->name('vms.fuel.bill.create');
        Route::post('/store', 'VehicleFuelBillSubmitController@store')->name('vms.fuel.bill.store');
        Route::put('/{id}', 'VehicleFuelBillSubmitController@update')->name('vms.fuel.bill.update');

        Route::POST('/acknowledgement',
            'VehicleFuelBillSubmitController@acknowledgement')->name('fuel.bill.acknowledgement');
    });
    // Maintenance Item related routes
    Route::prefix('maintenance-item')->group(function () {
        Route::get('/', 'VehicleMaintenanceItemController@index')->name('vms.maintenance.item.index');
        Route::get('/create', 'VehicleMaintenanceItemController@create')->name('vms.maintenance.item.create');
        Route::post('/store', 'VehicleMaintenanceItemController@store')->name('vms.maintenance.item.store');
        Route::get('/{id}/edit', 'VehicleMaintenanceItemController@edit')->name('vms.maintenance.item.edit');
        Route::put('/{id}', 'VehicleMaintenanceItemController@update')->name('vms.maintenance.item.update');
        Route::get('/show/{id}', 'VehicleMaintenanceItemController@show')->name('vms.maintenance.item.show');
        Route::delete('delete/{id}', 'VehicleMaintenanceItemController@destroy')->name('vms.maintenance.item.delete');
    });


    // requisition related routes
    Route::prefix('requisition')->group(function () {
        Route::get('/index', 'VehicleMaintenanceRequisitionController@index')->name('vms.requisition.index');
        Route::get('/create', 'VehicleMaintenanceRequisitionController@create')->name('vms.requisition.create');
        Route::post('/store', 'VehicleMaintenanceRequisitionController@store')->name('vms.requisition.store');
        Route::get('/show/{id}',
            'VehicleMaintenanceRequisitionController@show')->name('vms.requisition.work.flow.show');
        Route::put('/{id}', 'VehicleMaintenanceRequisitionController@update')->name('vms.requisition.update');
        Route::get('/{vmr}/status/{status}',
            'RequisitionWorkFlowController@changeStatus')->name('vms.requisition.change-status');
    });

    // fuel Bill workflow show related routes
    Route::prefix('fuel-bill-work-flow')->group(function () {
        Route::get('/show/{id}', 'VehicleFuelBillWorkFlowController@show')->name('vms.fuel.Bill.workflow.show');
        Route::get('/{fuelBill}/status/{status}',
            'VehicleFuelBillWorkFlowController@changeStatus')->name('vms.fuel.bill.change-status');

    });

});
