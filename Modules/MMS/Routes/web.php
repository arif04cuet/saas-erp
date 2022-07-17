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

Route::middleware(['auth', 'can:guest_access'])->prefix('mms')->group(function () {
    Route::get('/', 'MMSController@index')->name('mms');
    Route::resource('patients', 'PatientController');
    Route::delete('delete/{id}', 'PatientController@destroy')->name('patients.delete');
    Route::get('/get-employee-details', 'PatientController@getEmployeeController')->name('get-employee-details');
    Route::get('/get-trainings-list', 'PatientController@getTrainingsList')->name('get-trainings-list');
    Route::get('/get-trainee-list', 'PatientController@getTraineeByTrainingsId')->name('get-trainee-list');
    Route::get('/get-trainee-information', 'PatientController@fetchTraineesWithID')->name('get-trainee-information');
    Route::get('/prescriptions', 'PrescriptionController@index')->name('prescriptions.index');
    Route::get('/prescriptions/show/{id}', 'PrescriptionController@show')->name('prescription.show');
    Route::get('/inventory/quantity', 'MedicineDistributionController@getInventoryMedicineQuantity')->name('inventories.prescribed.quantity');
    Route::get('/prescriptions-list/{id}', 'PrescriptionController@prescriptionListByPatient')->name('prescriptions.list_by_user');
    Route::middleware(['auth', 'can:medical-doctor-access'])->group(function () {


        Route::prefix('prescriptions')->group(function () {
            // Route::get('/', 'PrescriptionController@index')->name('prescriptions.index');
            Route::get('/create', 'PrescriptionController@create')->name('prescriptions.create');
            Route::get('/patients/relative', 'PatientController@relative')->name('patients.relative');
            Route::POST('/store', 'PrescriptionController@store')->name('prescriptions.store');
            Route::put('update/{id}', 'PrescriptionController@update')->name('prescriptions.update');
            // Route::get('/show/{id}', 'PrescriptionController@show')->name('prescription.show');
            Route::get('/{id}/edit', 'PrescriptionController@Edit')->name('prescription.edit');
            Route::get('/prescription/medicine/delete', 'PrescriptionController@medicineDelete')->name('prescription.medicine.delete');
            Route::get('/prescription/test/delete', 'PrescriptionController@testDelete')->name('prescription.test.delete');
        });
    });
    Route::middleware(['auth', 'can:medical-phamacist-access'])->group(function () {
        // Route::prefix('prescriptions')->group(function () {
        //     //

        // });


        Route::prefix('company')->group(function () {
            Route::get('/', 'MedicineCompanyController@index')->name('company.index');
            Route::get('create', 'MedicineCompanyController@create')->name('medicine-company.create');
            Route::post('store', 'MedicineCompanyController@store')->name('medicine-company.store');
            Route::get('{company}/edit', 'MedicineCompanyController@edit')->name('medicine-company.edit');
            Route::get('show/{id}', 'MedicineCompanyController@show')->name('medicine-company.show');
            Route::put('update/{id}', 'MedicineCompanyController@update')->name('medicine-company.update');
            Route::delete('delete/{id}', 'MedicineCompanyController@destroy')->name('medicine-company.delete');
        });
        Route::prefix('medicine')->group(function () {
            Route::get('/', 'MedicineController@index')->name('medicine.index');
            Route::get('create', 'MedicineController@create')->name('medicine.create');
            Route::post('store', 'MedicineController@store')->name('medicine.store');
            Route::get('{medicine}/edit', 'MedicineController@edit')->name('medicine.edit');
            Route::get('show/{id}', 'MedicineController@show')->name('medicine.show');
            Route::put('update/{id}', 'MedicineController@update')->name('medicine.update');
            Route::delete('delete/{id}', 'MedicineController@destroy')->name('medicine.delete');
        });

        Route::prefix('inventories')->group(function () {
            Route::prefix('medicines')->group(function () {
                Route::get('/', 'MedicineInventoryController@index')->name('inventories.medicines.index');
                Route::get('/create', 'MedicineInventoryController@create')->name('inventories.medicines.create');
                Route::POST('/store', 'MedicineInventoryController@store')->name('inventories.medicines.store');

                Route::get('/show/{id}', 'MedicineInventoryController@show')->name('inventories.medicines.show');
                Route::get('{medicine}/edit', 'MedicineInventoryController@edit')->name('inventories.medicines.edit');
                Route::put('update/{id}', 'MedicineInventoryController@update')->name('inventories.medicines.update');

            });
            Route::prefix('prescribed')->group(function () {
                Route::get('/', 'MedicineDistributionController@index')->name('inventories.prescribed.index');
                Route::get('/create', 'MedicineDistributionController@create')->name('inventories.prescribed.create');
                Route::post('/store', 'MedicineDistributionController@store')->name('inventories.prescribed.store');

                Route::get('/show/{id}', 'MedicineDistributionController@show')->name('inventories.prescribed.show');
                Route::POST('/acknowledgement', 'MedicineDistributionController@acknowledgement')->name('inventories.prescribed.acknowledgement');
                Route::get('/edit', function () {
                    return view('mms::inventories.prescribed.edit');
                })->name('inventories.prescribed.edit');
            });


        });
        Route::prefix('requisition')->group(function () {
            Route::get('/', 'MedicineRequisitionController@index')->name('requisition.index');
            Route::get('/create', 'MedicineRequisitionController@create')->name('requisition.create');
            Route::post('/store', 'MedicineRequisitionController@store')->name('requisition.store');
            Route::get('/inventory/quantity', 'MedicineRequisitionController@getInventoryMedicineQuantity')->name('requisition.quantity');
            Route::get('/show/{id}', 'MedicineRequisitionController@show')->name('requisition.show');
            Route::get('/edit/{id}', 'MedicineRequisitionController@edit')->name('requisition.edit');
            Route::get('delete', 'MedicineRequisitionController@delete')->name('requisition.delete');
            Route::POST('update/{id}', 'MedicineRequisitionController@update')->name('requisition.update');
        });


    });
});
