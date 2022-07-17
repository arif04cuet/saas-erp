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

Route::prefix('publication')->middleware(['auth'])->group(function () {
   Route::get('/', 'PublicationController@index')->name('publication');

   Route::middleware(['can:publication-menu-access'])->group(function () {
      Route::resources([
         'publication-inventories' => 'PublicationInventoryController',
         'publication-presses' => 'PublicationPressController',
         'publication-types' => 'PublicationTypeController',
         'publication-organizations' => 'PublicationOrganizationController',
         'research-paper-free-requests' => 'ResearchPaperFreeRequestController',
         'publication-income-expense-entries' => 'PublicationIncomeExpenseEntryController',

      ]);
      Route::get('/accept-employee-paper-requests/{id}', 'EmployeePaperRequestController@acceptRequest')->name('publication.accept-employee-paper-requests');
      Route::get('/get-inventory-available-amaount/{id}', 'ResearchPaperFreeRequestController@getAvailableAmount');


      Route::prefix('publication-requests')->group(function () {
         Route::get('/', 'PublicationRequestController@index')->name('publication.publication-requests');
         Route::get('/show/{id}', 'PublicationRequestController@show')->name('publication.publication-requests.show');
         Route::put('/update/{id}', 'PublicationRequestController@update')->name('publication.publication-requests.update');
      });

      Route::prefix('published-research-papers')->group(function () {
         Route::put('/proof-request/{id}', 'PublishedResearchPaperController@proofRequest')->name('publication.published-research-papers.proof_request');
         Route::get('/send-to-press/{id}', 'PublishedResearchPaperController@sendToPressView')->name('publication.published-research-papers.send_to_press');
         Route::post('/store', 'PublishedResearchPaperController@store')->name('publication.published-research-papers.store');
      });
   });
   Route::resources([
      'employee-paper-requests' => 'EmployeePaperRequestController',
   ]);

   Route::prefix('published-research-papers')->group(function () {
      Route::get('/', 'PublishedResearchPaperController@index')->name('publication.published-research-papers.index');
      Route::get('/show/{id}', 'PublishedResearchPaperController@show')->name('publication.published-research-papers.show');
      Route::put('/proof-request/{id}', 'PublishedResearchPaperController@proofRequest')->name('publication.published-research-papers.proof_request');
   });
});
