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

Route::middleware(['auth', 'can:guest_access'])->prefix('cafeteria')->group(function () {

    Route::get('/', 'CafeteriaController@index')->name('cafeteria');

    Route::middleware(['can:cafeteria-menu-access'])->group(function () {
        /** Purchase List */
        Route::prefix('purchase-lists')->group(function () {
            Route::get('/convert-grand-total', 'PurchaseListController@convertGrandTotal')->name('purchase_lists.convert_grand_total');
            Route::get('/approval/{id}', 'PurchaseListController@approvalForm')->name('purchase-lists.approval');
            Route::put('/approval/{id}', 'PurchaseListController@approvePurchaseList')->name('purchase-lists.approval');
        });

        /** Raw Material */
        Route::prefix('raw-materials')->group(function () {
            Route::put('/change-status/{id}', 'RawMaterialController@changeMaterialStatus')->name('raw_materials.change_status');
        });

        /** Food Sales */
        Route::prefix('sales')->group(function () {
            Route::get('get-bill-to-data', 'SalesController@getBillToData');
            Route::get('get-employee-salary-grade/{id}', 'SalesController@getEmployeeSalaryGrade');
        });

        /** Food Order */
        Route::prefix('food-orders')->group(function () {
            Route::get('/approval/{id}', 'CafeteriaFoodOrderController@approvalForm')->name('food-orders.approval');
            Route::put('/approval/{id}', 'CafeteriaFoodOrderController@approvePurchaseList')->name('food-orders
            .approval');
        });

        /** Special Group */
        Route::prefix('special-groups')->group(function () {
            Route::get('get-group-data', 'SpecialGroupController@getGroupDataForBill')->name('get-group-data');
            Route::post('special-group-bill', 'SpecialGroupBillController@specialBillAsJson')->name('get-special-group-bill');
        });

        /** Deliver Materials */
        Route::prefix('deliver-materials')->group(function () {
            Route::get('/approval/{id}', 'DeliverMaterialController@approvalForm')->name('deliver-materials.approval');
            Route::put('/approval/{id}', 'DeliverMaterialController@approveDeliverList')->name('deliver-materials.approval');
        });

        /** Unsold Food */
        Route::prefix('unsold-foods')->group(function() {
           Route::get('/', 'CafeteriaUnsoldFoodController@index')->name('unsold-foods.index');
           Route::post('move-unsold-food', 'CafeteriaUnsoldFoodController@moveUnsoldFoods')->name('unsold-foods.move-unsold-food');
           Route::get('/{id}', 'CafeteriaUnsoldFoodController@moveUnsoldFoods')->name('unsold-foods.show');
        });

        /** Purchase List Report */
        Route::prefix('reports')->group(function () {
            Route::get('/purchase-list-report-form', 'CafeteriaReportController@purchaseItemListReportForm')->name('reports.purchase-list-report-form');
            Route::get('/purchase-list-report', 'CafeteriaReportController@purchaseItemListReport')->name('reports.purchase-list-report');
            Route::get('/sales-report-form', 'CafeteriaReportController@salesReportForm')->name('reports.sales-report-form');
            Route::get('/sales-report', 'CafeteriaReportController@salesReport')->name('reports.sales-report');
        });

        Route::resources([
            'purchase-lists' => 'PurchaseListController',
            'units' => 'UnitController',
            'venues' => 'VenueController',
            'raw-materials' => 'RawMaterialController',
            'cafeteria-inventories' => 'CafeteriaInventoryController',
            'food-menus' => 'FoodMenuController',
            'finish-foods' => 'FinishFoodController',
            'sales' => 'SalesController',
            'special-groups' => 'SpecialGroupController',
            'special-purchase-lists' =>'SpecialPurchaseListController',
            'special-group-bills' => 'SpecialGroupBillController',
            'deliver-materials' => 'DeliverMaterialController',
            'venue-selections' => 'VenueSelectionController',
            'income-expense-entries' => 'CafeteriaIncomeExpenseEntryController',
            'raw-material-categories' => 'RawMaterialCategoryController',
        ]);
    });

    /** Finish Food */
    Route::get('/finish-foods', 'FinishFoodController@index')->name('finish-foods.index');
    Route::prefix('finish-foods')->group(function () {
        Route::post('/filter', 'FinishFoodController@filterAsJson')->name('finish-foods.filter');
    });

     /** Ajax Request URL */
     Route::get('get-unit-by-material/{id}', 'RawMaterialController@getUnitByMaterial')->name('raw_materials.get_unit_by_material');

     Route::prefix('sales')->group(function () {
        Route::get('get-bill-to-data', 'SalesController@getBillToData');
    });

    /** Food Order */
    Route::resource('food-orders', 'CafeteriaFoodOrderController');
});
