<?php

use Illuminate\Support\Facades\Route;
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
Route::middleware(['auth', 'can:hm-access', 'can:guest_access'])->group(function () {
    
    Route::prefix('hm')->group(function () {
        Route::get('/', 'HMController@index')->name('hm');
        Route::get('show', 'HMController@show'); // Temporary & Demo

        Route::prefix('hostels')->group(function () {
            Route::get('/', 'HostelController@index')->name('hostels.index');
            Route::post('/vacancy-report',
                'HostelController@getVacancySearchView')->name('hostels.get-vacancy-search-view');
            Route::get('create', 'HostelController@create')->name('hostels.create');
            Route::post('/', 'HostelController@store')->name('hostels.store');
            Route::get('{hostel}/edit', 'HostelController@edit')->name('hostels.edit');
            Route::get('{hostel}', 'HostelController@show')->name('hostels.show');
            Route::put('{hostel}', 'HostelController@update')->name('hostels.update');
            Route::delete('{hostel}', 'HostelController@destroy')->name('hostels.destroy');
        });

        Route::prefix('reports')->group(function () {
            Route::get('/collection-report', 'HostelReportController@index')->name('hostels.collection-report');
            Route::post('/collection-report',
                'HostelReportController@filterCollectionRegister')->name('collection-report.filter');
            Route::get('/collection-report-print-view/{from}/{to}',
                'HostelReportController@printView')->name('collection-report.print-view');
        });

        Route::prefix('room-types')->group(function () {
            Route::get('/', 'RoomTypeController@index')->name('room-types.index');
            Route::get('create', 'RoomTypeController@create')->name('room-types.create');
            Route::post('create', 'RoomTypeController@store')->name('room-types.store');
            Route::get('{roomType}/edit', 'RoomTypeController@edit')->name('room-types.edit');
            Route::put('{roomType}', 'RoomTypeController@update')->name('room-types.update');
            Route::delete('{roomType}', 'RoomTypeController@destroy')->name('room-types.destroy');
        });

        Route::prefix('rooms')->group(function () {
            Route::get('/', 'RoomController@index')->name('rooms.index');
            Route::get('create/{hostel}', 'RoomController@create')->name('rooms.create');
            Route::post('/', 'RoomController@store')->name('rooms.store');
            Route::get('{room}/edit', 'RoomController@edit')->name('rooms.edit');
            Route::put('{room}', 'RoomController@update')->name('rooms.update');
            Route::delete('{room}', 'RoomController@destroy')->name('rooms.destroy');
            Route::get('detail', 'RoomController@show')->name('room.detail'); // Temporary & Demo
            Route::get('history', 'RoomController@history')->name('room.history'); // Temporary & Demo
            Route::get('/seat/assign', 'RoomAssignmentController@index')->name('room.assign');
            Route::post('/seat/assign', 'RoomAssignmentController@store')->name('room.assign');
            Route::get('/hostel/selection', 'RoomAssignmentController@getHostelList')->name('hostel.selection');
            Route::put('{room}/status', 'RoomStatusController@update')->name('rooms.status.update');
            Route::get('/assigned-guest/{roomId}/{checkinId}', 'RoomAssignmentController@getAlreadyAssignedGuest');
        });

        // HM Inventory
        Route::prefix('inventory')->group(function () {
            // HM Inventory Request Routes
            Route::get('/requests', 'HmInventoryController@index')->name('hm-inventory-request.index');
            Route::get('/requests/{inventoryRequest}/show', 'HmInventoryController@show')
                ->name('hm-inventory-request.show');

            // HM Inventory Location/Store Routes
            Route::get('/locations', 'HmInventoryController@locations')->name('hm-inventory-locations.index');
            Route::get('/locations/{location}/show', 'HmInventoryController@showLocation')
                ->name('hm-inventory-locations.show');
        });

        Route::prefix('inventory-items')->group(function () {
            Route::get('create', 'InventoryItemController@create')->name('inventory-items.create');
            Route::post('/', 'InventoryItemController@store')->name('inventory-items.store');
        });

        Route::prefix('room-types')->group(function () {
            Route::get('create', 'RoomTypeController@create')->name('room-types.create');
        });

        Route::prefix('hostel-budgets')->group(function () {
            Route::get('create', 'HostelBudgetController@create')->name('hostel-budgets.create');
            Route::get('/', 'HostelBudgetController@index')->name('hostel-budgets.index');
            Route::get('/edit/{id}', 'HostelBudgetController@edit')->name('hostel-budgets.edit');
            Route::post('/hostel-budgets.update/{id?}', 'HostelBudgetController@update')->name('hostel-budgets.update');
            Route::post('/', 'HostelBudgetController@store')->name('hostel-budgets.store');
            Route::post('/approve/{id}', 'HostelBudgetController@approve')->name('hostel-budgets.approve');
            Route::get('/{id}', 'HostelBudgetController@show')->name('hostel-budgets.show');
        });

        Route::resources(
            [
                'hostel-budget-section' => 'HostelBudgetSectionController',
//			'hostel-budget' => 'HostelBudgetController',
            ]
        );

        Route::prefix('annual-purchases')->group(function () {
            Route::get('create', 'AnnualPurchaseController@create')->name('annual-purchases.create');
            Route::post('/', 'AnnualPurchaseController@store')->name('annual-purchases.store');
        });

        Route::prefix('stores')->group(function () {
            Route::get('create', 'HostelStoreController@create')->name('stores.create');
            Route::post('/', 'HostelStoreController@store')->name('stores.store');
        });

        Route::prefix('booking-requests')->group(function () {
            Route::get('/', 'BookingRequestController@index')->name('booking-requests.index');
            Route::get('create', 'BookingRequestController@create')->name('booking-requests.create');
            Route::post('/', 'BookingRequestController@store')->name('booking-requests.store');
            Route::get('/{roomBooking}/edit',
                'BookingRequestController@edit')->name('booking-requests.edit')->middleware('can:admin-hm-access');
            Route::put('/{roomBooking}',
                'BookingRequestController@update')->name('booking-requests.update')->middleware('can:admin-hm-access');
            Route::get('/{roomBooking}', 'BookingRequestController@show')->name('booking-requests.show');
            Route::put('{roomBooking}/status',
                'BookingRequestStatusController@update')->name('booking-request-status.edit');
            Route::put('{roomBooking}/status/approve',
                'BookingRequestStatusController@approve')->name('booking-request-status.approve');
            Route::post('forward/{roomBooking}',
                'BookingRequestForwardController@store')->name('booking-requests-forward');
        });


        Route::prefix('booking-request-rates')->group(function () {
            Route::get('create', 'HostelBookingRateController@create')->name('booking-request-rates.create');
        });

        Route::prefix('check-in')->group(function () {
            Route::get('/', 'CheckinController@index')->name('check-in.index');
            Route::get('/create-options', 'CheckinController@createOptions')->name('check-in.create-options');
            Route::get('/create/{roomBooking?}', 'CheckinController@create')->name('check-in.create');
            Route::post('/store/{roomBookingId?}', 'CheckinController@store')->name('check-in.store');
            Route::get('approved-booking-requests/{isTraining?}',
                'CheckinController@approvedRequests')->name('check-in.approved-booking-requests');
            Route::get('edit', 'CheckinController@edit')->name('check-in.edit'); // Temporary & Demo
            Route::get('{roomBooking}', 'CheckinController@show')->name('check-in.show');
            Route::get('{roomBooking}/payments', 'CheckinPaymentController@index')->name('check-in-payments.index');
            Route::get('{roomBooking}/payments/create',
                'CheckinPaymentController@create')->name('check-in-payments.create');
            Route::post('{roomBooking}/payments', 'CheckinPaymentController@store')->name('check-in-payments.store');
            Route::get('{roomBooking}/payments/{checkinPayment}/show',
                'CheckinPaymentController@show')->name('check-in-payments.show');
            Route::get('{roomBooking}/bills', 'CheckinBillController@index')->name('check-in-bill.index');
            // routes for training related booking check-in
            Route::prefix('approved-training')->group(function () {
                Route::get('/create', 'CheckInApprovedTrainingController@create')
                    ->name('check-in.approved-training.create');
                Route::get('/{roomBooking}', 'CheckInApprovedTrainingController@show')
                    ->name('check-in.approved-training.show');
                Route::post('/', 'CheckInApprovedTrainingController@store')
                    ->name('check-in.approved-training.store');
                Route::get('/{roomBooking}/json', 'CheckInApprovedTrainingController@json')
                    ->name('check-in.approved-training.json');
            });
            // routes for training related booking check-in
            Route::prefix('approved-physical-facility')->group(function () {
                Route::get('/create', 'CheckinApprovedPhysicalFacilityController@create')
                    ->name('check-in.approved-physical-facility.create');
                Route::get('/{roomBooking}', 'CheckinApprovedPhysicalFacilityController@show')
                    ->name('check-in.approved-physical-facility.show');
                Route::post('/', 'CheckinApprovedPhysicalFacilityController@store')
                    ->name('check-in.approved-physical-facility.store');
                Route::get('/{roomBooking}/json', 'CheckinApprovedPhysicalFacilityController@json')
                    ->name('check-in.approved-physical-facility.json');
            });


        });

        Route::post('check-out/{roomBooking}', 'CheckoutController@update')->name('check-out.update');

        Route::prefix('bill')->group(function () {
            Route::get('/', 'BillController@index')->name('bill.index'); // Temporary & Demo
            Route::get('search-check-in',
                'BillController@searchCheckIn')->name('bill.search-check-in'); // Temporary & Demo
            Route::get('create', 'BillController@create')->name('bill.create'); // Temporary & Demo
            Route::get('show/{id}', 'BillController@show')->name('bill.show'); // Temporary & Demo
            Route::get('payment', 'BillController@payment')->name('bill.payment'); // Temporary & Demo
            Route::get('payment-list', 'BillController@paymentList')->name('bill.payment-list'); // Temporary & Demo
            Route::get('payment-of-check-in',
                'BillController@showPaymentsOfCheckIn')->name('bill.payments-of-check-in'); // Temporary & Demo
        });

        /**----------- Hostel Accounts Related Url's-------------------*/
        Route::prefix('accounts/')->group(function () {

            // HM Code Settings Url's
            Route::prefix('code-settings/')->group(function () {
                Route::get('/create',
                    'HmCodeSettingController@create')->name('hm.accounts.code-setting.create');
                Route::get('/',
                    'HmCodeSettingController@index')->name('hm.code-setting.index');
                Route::get('/edit',
                    'HmCodeSettingController@edit')->name('accounts.hm.code-setting.edit');
                Route::put('/', 'HmCodeSettingController@update')
                    ->name('accounts.hm.code-setting.update');
                Route::post('/', 'HmCodeSettingController@store')->name('accounts.hm.code-setting.store');
            });

            // Hm journal Entry Related Url's
            Route::prefix('journal-entries')->group(function () {
                Route::get('/create', 'HmJournalEntryController@create')->name('hm.accounts.journal-entries.create');
                Route::get('/', 'HmJournalEntryController@index')->name('hm.accounts.journal-entries.index');
                Route::get('/{hmJournalEntry}',
                    'HmJournalEntryController@show')->name('hm.accounts.journal-entries.show');
                Route::post('/', 'HmJournalEntryController@store')->name('hm.accounts.journal-entries.store');
            });
            // Report Related Url's
            Route::prefix('report/')->group(function () {
                // Annual Budget Report
                Route::prefix('annual-budgets')->group(function () {
                    Route::get('/{hostelBudgetTitle}',
                        'HmAnnualBudgetReportController@create')->name('hm.accounts.report.annual-budgets.create');
                    Route::get('/{hostelBudgetTitle}/print',
                        'HmAnnualBudgetReportController@print')->name('hm.accounts.report.annual-budgets.print');
                    Route::get('/',
                        'HmAnnualBudgetReportController@index')->name('hm.accounts.report.annual-budgets.index');

                });
                // other reports urls should be listed below .... (monthly report, budget report etc)
            });

            // HM Code Settings Url's
            Route::prefix('code-settings/')->group(function () {
                Route::get('/create',
                    'HmCodeSettingController@create')->name('hm.accounts.code-setting.create');
                Route::get('/',
                    'HmCodeSettingController@index')->name('hm.accounts.code-setting.index');
                Route::get('/edit',
                    'HmCodeSettingController@edit')->name('hm.accounts.code-setting.edit');
                Route::put('/', 'HmCodeSettingController@update')
                    ->name('hm.accounts.code-setting.update');
                Route::post('/', 'HmCodeSettingController@store')->name('hm.accounts.code-setting.store');
            });

        });
    });
});

