<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

//------------Backend routes ------------------
Auth::routes();
Route::impersonate();
Route::middleware(['auth'])
    ->prefix(config('app.admin_prefix'))
    ->group(function () {

        Route::middleware(['force_password'])->group(function () {

            // Route::get('/home', 'HomeController@index')->name('home');
            Route::get('/', 'DashboardController@landing')->name('dashboard');
            Route::get('users-datatable', 'UserController@index_datatable');
            Route::resource('users', 'UserController');
            Route::resource('roles', 'RoleController');
            Route::resource('permissions', 'PermissionController');

            Route::get('doptors/sync', function () {
                Artisan::call('sync:doptor', []);
            });
            Route::resource('doptors', DoptorController::class);
            // Route::get('doptor/list', 'DoptorController@index');
            // Route::get('doptor/show', 'DoptorController@show');
            // Route::get('doptor/edit/{id}', 'DoptorController@edit');
            // Route::put('doptor/update/{id}', 'DoptorController@update')->name('doptor.update');



            Route::resource('module', 'ModuleController');
        });

        Route::get('/change/password', 'ChangePasswordController@change')->name('change.password');
        Route::post('/change/password', 'ChangePasswordController@update')->name('change.password.post');


        // organisation
        /*
     * Only store method is used from OrganizationController,Everything else is from PMS-OrganizationController
     */
        Route::post('organizations', 'OrganizationController@store')->name('organizations.store');

        // attributes
        Route::prefix('attributes')->group(function () {
            Route::put('{attribute}', 'AttributeController@update')->name('attributes.update');
            // attribute-values
            Route::prefix('{attribute}')->group(function () {
                Route::post('values', 'MemberAttributeValueController@store')->name('attribute-values.store');
                Route::put(
                    'values/{attributeValue}',
                    'MemberAttributeValueController@update'
                )->name('attribute-values.update');
                Route::get('graphs', 'AttributeValueGraphController@update')->name('attribute-values.graph');
            });
        });

        //Notifications
        Route::get('/notification/count', 'AppNotificationController@countUnread')->name('notification.count');
        Route::get('/unread/notifications', 'AppNotificationController@getUnreadNotification')->name('notification.unread');
        Route::get(
            '/latest/notifications',
            'AppNotificationController@getLatestNotifications'
        )->name('notification.latest');
        Route::get('/all/notifications', 'AppNotificationController@index')->name('notification.index');
        Route::get('/read/notifications', 'AppNotificationController@markAsRead')->name('notification.read');
        Route::get('/clear/notifications', 'AppNotificationController@clearAll')->name('notification.clear');

        // districts
        Route::get('divisions/{division}/districts', function (\App\Entities\Division $division) {
            return $division->districts;
        });
        // thanas
        Route::get('districts/{district}/thanas', function (\App\Entities\District $district) {
            return $district->thanas;
        });
        // unions
        Route::get('thanas/{thana}/unions', function (\App\Entities\Thana $thana) {
            return $thana->unions;
        });
        // single union detail
        Route::get('/union/{union}', function (\App\Entities\Union $union) {
            return array($union, $union->thana->district->division, $union->thana->district, $union->thana);
        });
    });



//------------Frontend routes ------------------
Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'NewsLetterController@store')->name('email.create');
Route::get('/search-course', 'LandingPageSearchController@searchCourse')->name('search.course');
Route::get('/offline-course', 'HomeController@offlineCourseListPublicView')->name('offline.courses.public.view');
//Public Booking Request
Route::get('hostel', 'PublicBookingRequestController@hostel')->name('hostel');
Route::get('booking-requests-create', 'PublicBookingRequestController@create')->name('public-booking-requests.create');
Route::post('booking-requests-store', 'PublicBookingRequestController@store')->name('public-booking-requests.store');
Route::get(
    'booking-request/confirmation/{uniqueKey?}',
    'PublicBookingRequestController@confirmation'
)->name('public-booking-request.confirmation');
Route::put('{VendorConfirmationID}/status/approve', 'PublicBookingRequestController@approve')
    ->name('public-booking-request.approve');
Route::put('{roomBookingID}/{VendorConfirmationID}/status/reject', 'PublicBookingRequestController@reject')
    ->name('public-booking-request.reject');

//booking-request cancel related url's
Route::get('booking-requests/check', '\Modules\HM\Http\Controllers\BookingRequestCancelController@check')
    ->name('booking-requests.check');
Route::get(
    'booking-requests/check/show',
    '\Modules\HM\Http\Controllers\BookingRequestCancelController@show'
)
    ->name('booking-requests.check.show');
Route::post('booking-requests/cancel', '\Modules\HM\Http\Controllers\BookingRequestCancelController@cancel')
    ->name('booking-requests.cancel');


// Physical Facility Request
Route::get('physical-facility-requests', 'PhysicalFacilityRequestController@create')
    ->name('physical-facility-requests.create');
Route::post('physical-facility-requests', 'PhysicalFacilityRequestController@store')
    ->name('physical-facility-requests.store');

// Annual Training Notification Response
Route::prefix('annual-training-notification/response/organization')->group(function () {
    // caution:: the routes are sent via email to organization, changes might occur routes not found exception.
    // organization routes
    Route::get(
        '/{uniqueKey}',
        '\Modules\TMS\Http\Controllers\AnnualTrainingNotificationResponseController@edit'
    )
        ->name('annual-training-notification.response.organization.create');
    Route::post(
        '/',
        '\Modules\TMS\Http\Controllers\AnnualTrainingNotificationResponseController@store'
    )
        ->name('annual-training-notification.response.organization.store');
});

//public Job Circular
$CircularController = '\Modules\HRM\Http\Controllers\CircularController';
Route::get('circular', "$CircularController@getAllPublicCircular")->name('public.circular');
Route::get('circular/{circularAttachment}/attachment-download', "$CircularController@attachmentDownload")
    ->name('circularAttachment.download');

// Job Application
Route::middleware(['expiryDate:jobCircular,application_deadline'])->group(function () {
    Route::get(
        'job-applications/create/{jobCircular}',
        'JobApplicationController@create'
    )->name('job-applications.create-public');
    Route::post(
        '{jobCircular}/job-applications',
        'JobApplicationController@store'
    )->name('job-applications.public.store');
});
Route::get('get-data-by-level/{level}', 'JobApplicationController@getDataByLevel')->name('get-data-by-level');
// Job Admit Card
$jobAdmitController = '\Modules\HRM\Http\Controllers\JobAdmitCardController';
Route::get('job-admit-cards/{admitCard}/download-admit/', "$jobAdmitController@admitCard")
    ->name('job-admit-cards.admit-card');
Route::post('job-admit-cards/{jobCircular}/download-admit/', "$jobAdmitController@postAdmitCard")
    ->name('job-admit-cards.download');
Route::get(
    'job-admit-cards/{admitCardId}/{applicantId}/{hash}/download-admit-file',
    "$jobAdmitController@downloadAdmitFile"
)->name('job-admit-cards.download-file');


//Get Thanas by District Name
Route::get(
    'thanas/{districtName}',
    'JobApplicationController@getThanasByDisctirctName'
)->name('thanas-by-district-name');

//Public Job Circulars
Route::get(
    'job-circulars',
    '\Modules\HRM\Http\Controllers\JobCircularController@circularList'
)->name('job-circulars.list');


//Training Registration
Route::prefix('training')->group(function () {
    Route::get('/', 'PublicTrainingRegistrationController@index')->name('training-registration.index');
    Route::get('/details', 'PublicTrainingRegistrationController@courseDetail')->name('course-detail');
    Route::prefix('{training}/registration')->group(function () {
        Route::get('create', 'PublicTrainingRegistrationController@create')->name('training-registration.create')
            ->middleware(['checkTrainingRegistrationDate:false,training']);
        Route::post('store', 'PublicTrainingRegistrationController@store')->name('training-registration.store')
            ->middleware(['checkTrainingRegistrationDate:false,training']);
        Route::get('check', 'PublicTrainingRegistrationController@check')
            ->name('trainings.trainees.registrations.check');
        Route::get('show/{trainee}', 'PublicTrainingRegistrationController@show')
            ->name('trainings.trainees.registrations.show');
        Route::post('verify', 'PublicTrainingRegistrationController@verify')
            ->name('trainings.trainees.registrations.verify')
            ->middleware(['checkTrainingRegistrationDate:false,training']);
        Route::post(
            'unique/trainee/{trainee?}',
            'PublicTrainingRegistrationController@unique'
        )->name('trainings.trainees.registrations.unique');
    });

    // Route public trainings, evaluation routes
    $TMS_MODULE_NAMESPACE = '\Modules\TMS\Http\Controllers';
    $PublicSpeakerEvaluationController = "$TMS_MODULE_NAMESPACE\PublicSpeakerEvaluationController";
    Route::get('search', "$PublicSpeakerEvaluationController@index")->name('trainings.public.index');
    Route::get('sessions', "$PublicSpeakerEvaluationController@show")->name('trainings.public.show');
    // $TrainingSpeakerAssessmentController = "$TMS_MODULE_NAMESPACE\TrainingSpeakgetCertificateLocalrAssessmentController";
    $TrainingSpeakerAssessmentController = "$TMS_MODULE_NAMESPACE\TrainingSpeakerAssessmentController";
    $TrainingCourseAssessmentController = "$TMS_MODULE_NAMESPACE\TrainingCourseAssessmentController";
    Route::get(
        'courses/{course}/sessions/{session}/speakers/{speaker}/trainees/{trainee}/create',
        "$TrainingSpeakerAssessmentController@create"
    )->name('public.speakers.evaluations.create');
    Route::post('evaluations', "$TrainingSpeakerAssessmentController@store")->name('public.speakers.evaluations.store')
        ->middleware([
            'sessionEvaluationExpiry:course,session,speaker,trainee',
            'sessionIsEvaluated:course,session,speaker,trainee'
        ]);

    // Route public Course evaluations
    $PublicCourseEvaluationController = "$TMS_MODULE_NAMESPACE\PublicCourseEvaluationController";
    Route::get('course-search', "$PublicCourseEvaluationController@index")->name('courses.public.index');
    Route::get('course-evaluation-lists', "$PublicCourseEvaluationController@show")->name('courses.public.show');
    Route::get(
        'courses/{course}/trainees/{trainee}/create',
        "$TrainingCourseAssessmentController@create"
    )->name('public.courses.evaluations.create')
        ->middleware(['courseEvaluationExpiry:course', 'courseIsEvaluated:course,trainee']);

    Route::PUT('courses/{course}/trainees/{trainee}/store', "$TrainingCourseAssessmentController@store")
        ->name('public.courses.evaluations.store')
        ->middleware(['courseEvaluationExpiry:course', 'courseIsEvaluated:course,trainee']);
    // Route::get(
    //     'courses/{course}/trainees/{trainee}/create',
    //     "$TrainingCourseAssessmentController@create"
    // )->name('public.courses.evaluations.create');

    // Route::PUT('courses/{course}/trainees/{trainee}/store', "$TrainingCourseAssessmentController@store")
    //     ->name('public.courses.evaluations.store');

    // Public Route: Training Certificate Verify and Show
    $trainingCertificateLinkController = "$TMS_MODULE_NAMESPACE\TrainingCertificateLinkController";
    Route::get('certificate/verify', "$trainingCertificateLinkController@verify")->name('training.certificate.verify');
    Route::get(
        'certificate/{training}/send',
        "$trainingCertificateLinkController@send"
    )->name('training.certificate.send');
    Route::get(
        'certificate/{uniqueCode}',
        "$trainingCertificateLinkController@show"
    )->name('training.certificate.show');
});


Route::get('/lang/{key}', function ($key) {
    Session::put('locale', $key);
    Session::save();
    return redirect()->back();
});

Route::get('/test/upload', 'AttachmentController@index')->name('test.upload-index');
Route::post('/test/upload', 'AttachmentController@uploadFile')->name('test.upload');
Route::get('/file/download', 'AttachmentController@downloadFile')->name('file.download');
Route::get('/file/get', 'AttachmentController@get')->name('file.getfile');
Route::get('/test/url/{fileName}', 'AttachmentController@fileUrl')->name('test.fileUrl');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::post('bulk-approve', 'ResearchBulkActionController@researchBulkAction')->name('research.bulk.action');
