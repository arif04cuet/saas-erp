<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/ims', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:api')->prefix('ims')->group(function () {

    Route::prefix('inventory-item-category')->group(function (){

        Route::get('unique-check','Inventory\InventoryCategoryController@uniqueCheck')
            ->name('inventory-item-category.unique-check');
    });
//});
