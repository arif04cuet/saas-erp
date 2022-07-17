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

Route::middleware(['auth', 'can:ims-access', 'can:guest_access'])->prefix('ims')->group(function () {

    Route::get('/', 'IMSController@index')->name('inventory');

    // Inventory
    Route::prefix('inventory')->group(function () {
        Route::get('/', 'Inventory\InventoryController@index')->name('inventory.index');
        Route::get('show/category/{inventoryItemCategory}',
            'Inventory\InventoryController@show')->name('inventory.show');
        Route::prefix('report')->group(function () {
            Route::get('users', 'Inventory\InventoryController@reportByUsers')->name('inventory.report.users');
            Route::get('category-items',
                'Inventory\InventoryController@reportByCategoryItems')->name('inventory.report.category-items');
        });

    });

    // Inventory Request
    Route::prefix('inventory-request')->group(function () {
        Route::get('/', 'Inventory\InventoryRequestController@index')->name('inventory-request.index');

        Route::get('{type}/create/initial', 'Inventory\InventoryRequestController@initialForm')
            ->name('inventory-request.create.initial')->where('type', 'requisition|transfer|scrap|abandon');
        Route::post('{type}/create/initial', 'Inventory\InventoryRequestController@storeInitial')
            ->name('inventory-request.store.initial');

        Route::get('{type}/{inventoryRequest}/edit/initial', 'Inventory\InventoryRequestController@initialEditForm')
            ->name('inventory-request.edit.initial')->where('type', 'requisition|transfer|scrap|abandon');
        Route::put('{type}/{inventoryRequest}/edit/initial', 'Inventory\InventoryRequestController@updateInitial')
            ->name('inventory-request.update.initial');

        Route::get('{type}/{inventoryRequest}/detail/create', 'Inventory\InventoryRequestController@detailForm')
            ->name('inventory-request.create.detail')->where('type', 'requisition|transfer|scrap|abandon');
        Route::post('{type}/{inventoryRequest}/detail/create',
            'Inventory\InventoryRequestController@storeDetail')->name('inventory-request.store.detail.create');

        Route::get('{type}/{inventoryRequest}/detail/edit', 'Inventory\InventoryRequestController@detailFormEdit')
            ->name('inventory-request.edit.detail')->where('type', 'requisition|transfer|scrap|abandon');
        Route::post('{type}/{inventoryRequest}/detail/edit',
            'Inventory\InventoryRequestController@updateDetail')->name('inventory-request.store.detail.edit');

        Route::get('{inventoryRequest}/show',
            'Inventory\InventoryRequestController@show')->name('inventory-request.show');
//        Route::delete('{inventoryRequest}/delete', 'Inventory\InventoryRequestController@destroy')->name('inventory-request.destroy');

        // Review Workflow
        Route::prefix('workflow')->group(function () {
            Route::get('{inventoryRequest}',
                'Inventory\InventoryRequestWorkflowController@show')->name('inventory-request.workflow.show')->middleware(['inventoryRequestRecipient']);
            Route::put('/',
                'Inventory\InventoryRequestWorkflowController@update')->name('inventory-request.workflow.update');
        });
    });

    // inventory-item-request
    Route::prefix('inventory-item-request')->group(function () {
        Route::get('/', 'InventoryItemRequestController@index')->name('inventory-item-request.index');
        Route::get('/create', 'InventoryItemRequestController@create')->name('inventory-item-request.create');
        Route::get('/{inventoryItemRequest}',
            'InventoryItemRequestController@show')->name('inventory-item-request.show');
        Route::get('{inventoryItemRequest}/edit',
            'InventoryItemRequestController@edit')->name('inventory-item-request.edit');
        Route::post('/', 'InventoryItemRequestController@store')->name('inventory-item-request.store');
        Route::put('{inventoryItemRequest}',
            'InventoryItemRequestController@update')->name('inventory-item-request.update');

        // Workflow
        Route::prefix('workflow')->group(function () {
            Route::get('{inventoryItemRequest}',
                'InventoryItemRequestWorkflowController@show')->name('inventory-item-request.workflow.show');
            Route::get('{inventoryItemRequest}/start',
                'InventoryItemRequestWorkflowController@startWorkflow')->name('inventory-item-request.workflow.start');
            Route::get('/{inventoryItemRequest}/status/{status}',
                'InventoryItemRequestWorkflowController@changeStatus')->name('inventory-item-request.workflow.change-status');
        });
    });

    // Asset Management
    Route::prefix('asset-managements')->group(function () {
        Route::get('/', 'AssetManagementController@index')->name('asset-managements.index');
        Route::get('/create', 'AssetManagementController@create')->name('asset-managements.create');
        Route::post('/store', 'AssetManagementController@store')->name('asset-managements.store');
        Route::get('/{id}/edit', 'AssetManagementController@edit')->name('asset-managements.edit');
        Route::put('/{id}/update', 'AssetManagementController@update')->name('asset-managements.update');
        Route::get('/{id}', 'AssetManagementController@show')->name('asset-managements.show');
    });

    // Appreciation Depreciation
    Route::prefix('appreciation-depreciation-records')->group(function () {
        Route::get('/', 'ItemAppreciationDepreciationRecordController@index')
            ->name('appreciation-depreciation-records.index');
        Route::get('/create/{id?}', 'ItemAppreciationDepreciationRecordController@create')
            ->name('appreciation-depreciation-records.create');
        Route::post('/store', 'ItemAppreciationDepreciationRecordController@store')
            ->name('appreciation-depreciation-records.store');
        Route::get('/{id}/edit', 'ItemAppreciationDepreciationRecordController@edit')
            ->name('appreciation-depreciation-records.edit');
        Route::put('/{id}/update', 'ItemAppreciationDepreciationRecordController@update')
            ->name('appreciation-depreciation-records.update');
        Route::get('/{id}', 'ItemAppreciationDepreciationRecordController@show')
            ->name('appreciation-depreciation-records.show');
    });

    // Procurement and Billing
    Route::prefix('procurement-billings')->group(function () {
        Route::get('/', 'ProcurementAndBillingController@index')->name('procurement-billings.index');
        Route::get('/create', 'ProcurementAndBillingController@create')->name('procurement-billings.create');
        Route::post('/store', 'ProcurementAndBillingController@store')->name('procurement-billings.store');
        Route::get('/{id}/edit', 'ProcurementAndBillingController@edit')->name('procurement-billings.edit');
        Route::put('/{id}/update', 'ProcurementAndBillingController@update')->name('procurement-billings.update');
        Route::get('/{id}', 'ProcurementAndBillingController@show')->name('procurement-billings.show');
    });

    // Procurement and Bill Settings
    Route::prefix('procurement-bill-settings')->group(function () {
        Route::get('/', 'ProcurementAndBillSettingController@index')->name('procurement-bill-settings.index');
        Route::get('/create', 'ProcurementAndBillSettingController@create')->name('procurement-bill-settings.create');
        Route::post('/store', 'ProcurementAndBillSettingController@store')->name('procurement-bill-settings.store');
        Route::get('/{id}/edit', 'ProcurementAndBillSettingController@edit')->name('procurement-bill-settings.edit');
        Route::put('/{id}/update',
            'ProcurementAndBillSettingController@update')->name('procurement-bill-settings.update');
        Route::get('/{id}', 'ProcurementAndBillSettingController@show')->name('procurement-bill-settings.show');
        Route::get('/{id}/activation', 'ProcurementAndBillSettingController@activation')
            ->name('procurement-bill-settings.activation');

        // Ajax route
        Route::get('/ajax/get-data/{id}', 'ProcurementAndBillSettingController@getData')
            ->name('procurement-bill-settings.get-data');
    });


    // Inventory Item
    Route::prefix('inventory-items')->group(function () {
        Route::get('/', 'Inventory\InventoryItemController@index')->name('inventory-items.index');
        Route::get('/{categoryId}/create', 'Inventory\InventoryItemController@create')->name('inventory-items.create');
        Route::post('/store', 'Inventory\InventoryItemController@store')->name('inventory-items.store');
        Route::get('/{id}/edit', 'Inventory\InventoryItemController@edit')->name('inventory-items.edit');
        Route::put('/{id}/update', 'Inventory\InventoryItemController@update')->name('inventory-items.update');
        Route::get('/{id}', 'Inventory\InventoryItemController@show')->name('inventory-items.show');
    });

    // Inventory Item Category
    Route::prefix('inventory-item-category')->group(function () {
        Route::get('/groups',
            'Inventory\InventoryCategoryController@index')->name('inventory-item-category-group.index');
        Route::get('/', 'Inventory\InventoryCategoryController@index')->name('inventory-item-category.index');
        Route::get('/departmental-item-categories',
            'Inventory\InventoryCategoryController@departmentalItemCategory')->name('inventory-item-category.departmental-item-categories');
        Route::get('/create', 'Inventory\InventoryCategoryController@create')->name('inventory-item-category.create');
        Route::post('/', 'Inventory\InventoryCategoryController@store')->name('inventory-item-category.store');
        Route::get('{inventoryItemCategory}/edit',
            'Inventory\InventoryCategoryController@edit')->name('inventory-item-category.edit');
        Route::put('{inventoryItemCategory}/update',
            'Inventory\InventoryCategoryController@update')->name('inventory-item-category.update');
        Route::get('{id}', 'Inventory\InventoryCategoryController@show')->name('inventory-item-category.show');
        Route::get('/group-by-categories/{id}', 'Inventory\InventoryCategoryController@groupByCategories')->name('inventory-item-category.group-by-categories');
        Route::post('price-store',
            'Inventory\InventoryCategoryController@addPrice')->name('inventory-item-price-store');

    });

    // Inventory Item Groups
    Route::prefix('inventory-category-group')->group(function () {
        Route::get('/', 'Inventory\InventoryCategoryGroupController@index')->name('inventory-category-group.index');
        Route::get('/create',
            'Inventory\InventoryCategoryGroupController@create')->name('inventory-category-group.create');
        Route::post('/', 'Inventory\InventoryCategoryGroupController@store')->name('inventory-category-group.store');
        Route::get('/{id}', 'Inventory\InventoryCategoryGroupController@show')->name('inventory-category-group.show');
        Route::get('/edit/{id}',
            'Inventory\InventoryCategoryGroupController@edit')->name('inventory-category-group.edit');
        Route::put('{InventoryCategoryGroupId}/update',
            'Inventory\InventoryCategoryGroupController@update')->name('inventory-category-group.update');
    });

    // Location
    Route::prefix('inventory-locations')->group(function () {
        Route::get('/', 'InventoryLocation\InventoryLocationController@index')->name('inventory-locations.index');
        Route::get('/create',
            'InventoryLocation\InventoryLocationController@create')->name('inventory-locations.create');
        Route::post('/', 'InventoryLocation\InventoryLocationController@store')->name('inventory-locations.store');
        Route::get('{location}',
            'InventoryLocation\InventoryLocationController@show')->name('inventory-locations.show');
        Route::get('{location}/edit',
            'InventoryLocation\InventoryLocationController@edit')->name('inventory-locations.edit');
        Route::put('{location}/update',
            'InventoryLocation\InventoryLocationController@update')->name('inventory-locations.update');
    });

    // Auction route
    Route::prefix('auctions')->group(function () {
        Route::get('/', 'Auction\AuctionController@index')->name('auctions.index');
        Route::get('/create', 'Auction\AuctionController@create')->name('auctions.create');
        Route::post('/create', 'Auction\AuctionController@store')->name('auctions.store');

        Route::get('/{auction}', 'Auction\AuctionController@show')->name('auctions.show')->where('auction', '[0-9]+');
        Route::get('/{auction}/edit', 'Auction\AuctionController@edit')->name('auctions.edit');
        Route::put('/{auction}/update', 'Auction\AuctionController@update')->name('auctions.update');

        // Auction sales
        Route::get('sales', 'AuctionSaleController@index')->name('auctions.sales.index');

        Route::prefix('{auction}/sales')->group(function () {
            Route::get('create', 'AuctionSaleController@create')->name('auctions.sales.create');
            Route::get('/{auctionSale}', 'AuctionSaleController@show')->name('auctions.sale.show');
            Route::post('/', 'AuctionSaleController@store')->name('auctions.sales.store');
        });

        // Auction Workflow
        Route::prefix('workflow')->group(function () {
            Route::get('{auction}', 'Auction\AuctionWorkflowController@show')->name('auction.workflow.show')
                ->middleware(['auctionRecipient']);
            Route::put('/', 'Auction\AuctionWorkflowController@update')->name('auction.workflow.update');
        });
    });

    // Vendor
    Route::prefix('vendor')->group(function () {
        Route::get('/', 'Vendor\VendorController@index')->name('vendor.index');
        Route::get('/create', 'Vendor\VendorController@create')->name('vendor.create');
        Route::post('/', 'Vendor\VendorController@store')->name('vendor.store');
        Route::get('/{vendor}', 'Vendor\VendorController@show')->name('vendor.show');
        Route::get('{vendor}/edit', 'Vendor\VendorController@edit')->name('vendor.edit');
        Route::put('{vendor}/update', 'Vendor\VendorController@update')->name('vendor.update');
    });


    Route::get('test', function (\Modules\IMS\Services\InventoryRequestService $service) {


    });
});
