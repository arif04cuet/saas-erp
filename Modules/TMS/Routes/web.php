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

Route::prefix('tms')->group(
    function () {
        Route::get('/', 'TMSController@index')->name('tms.dashboard')->middleware(['auth']);
        Route::get(
            '/get-filter-data/speaker-evaluations',
            'TrainingSpeakerAssessmentController@getfileterData'
        )->middleware(['auth']);

        Route::get(
            'get-trainees-of-training/{trainingId}',
            'TMSController@getTraineesOfTraining'
        ); // Important and Temporary

        //Training Wise Course Select using Ajax
        Route::get('get-course-by-training-id/{trainingId}', 'TrainingCourseController@getAllCourseByTrainingId')->name('get-courses');
        //Training Wise Course Select using Ajax
        Route::get('get-module-by-course-id/{courseId}', 'TrainingCourseModuleController@getAllModuleByCourseId')->name('get-modules');

        // TMS Inventory Routes
        Route::middleware(['auth', 'can:tms-menu-access', 'can:guest_access'])->prefix('inventory')->group(function () {
            // TMS Inventory Request Routes
            Route::get('/requests', 'TmsInventoryController@index')->name('tms-inventory-request.index');
            Route::get('/requests/{inventoryRequest}/show', 'TmsInventoryController@show')
                ->name('tms-inventory-request.show');

            // TMS Inventory Location/Store Routes
            Route::get('/locations', 'TmsInventoryController@locations')->name('tms-inventory-locations.index');
            Route::get('/locations/{location}/show', 'TmsInventoryController@showLocation')
                ->name('tms-inventory-locations.show');

            // inventory item request
            Route::get(
                '/item-requests',
                '\Modules\IMS\Http\Controllers\InventoryItemRequestController@tmsIndex'
            )->name('tms-inventory-item-request.index');
        });
        // training-type url's
        Route::middleware([
            'auth',
            'can:tms-menu-access',
            'can:tms-department-menu-access'
        ])->prefix('training-type')->group(
            function () {
                Route::get('/', 'TrainingTypeController@index')->name('training-type.index');
                Route::post('/', 'TrainingTypeController@store')->name('training-type.store');
                // Route::get('/create', 'TrainingTypeController@index')->name('training-type.create');
                Route::get('{trainingType}', 'TrainingTypeController@show')->where(
                    'trainingType',
                    '[0-9]+'
                )->name('training-type.show');
                Route::get('{trainingType}/edit', 'TrainingTypeController@edit')->name('training-type.edit');
                Route::put('{trainingType}', 'TrainingTypeController@update')->name('training-type.update');
                Route::delete('{trainingTypeId}', 'TrainingTypeController@destroy')->name('training-type.delete');
            }
        );
        // training-year url's
        Route::middleware([
            'auth',
            'can:tms-menu-access',
            'can:tms-department-menu-access'
        ])->prefix('training-year')->group(
            function () {
                Route::get('/', 'TrainingYearController@index')->name('training-year.index');
                Route::post('/', 'TrainingYearController@store')->name('training-year.store');
                // Route::get('/create', 'TrainingYearController@index')->name('training-type.create');
                Route::get('{trainingYear}', 'TrainingYearController@show')->where(
                    'trainingYear',
                    '[0-9]+'
                )->name('training-year.show');
                Route::get('{trainingYear}/edit', 'TrainingYearController@edit')->name('training-year.edit');
                Route::put('update/{trainingYear}', 'TrainingYearController@update')->name('training-year.update');
                Route::delete('{trainingYearId}', 'TrainingYearController@destroy')->name('training-year.delete');
            }
        );
        // training-head url's
        Route::middleware([
            'auth',
            'can:tms-menu-access',
            'can:tms-department-menu-access'
        ])->prefix('training-name')->group(
            function () {
                Route::get('/', 'TrainingHeadController@index')->name('training-head.index');
                Route::post('/', 'TrainingHeadController@store')->name('training-head.store');
                // Route::get('/create', 'TrainingHeadController@create')->name('training-head.create');
                Route::get('{trainingHead}', 'TrainingHeadController@show')->where(
                    'trainingHead',
                    '[0-9]+'
                )->name('training-head.show');
                Route::get('{trainingHead}/edit', 'TrainingHeadController@edit')
                    ->name('training-head.edit');
                Route::put('{trainingHead}', 'TrainingHeadController@update')->name('training-head.update');
                Route::delete('{trainingNameId}', 'TrainingHeadController@destroy')->name('training-name.delete');
            }
        );


        // Route group for all request regarding training
        Route::middleware(['auth'])->prefix('training')->group(
            function () {
                Route::get(
                    '/',
                    'TrainingController@index'
                )->name('training.index')->middleware(['can:tms-department-menu-access']);
                Route::get(
                    '/offline',
                    'TrainingController@trainingForOffline'
                )->name('offline-training')->middleware(['can:tms-department-menu-access']);
                Route::get('{training_id}', 'TrainingController@show')->where('training_id', '[0-9]+')
                    ->name('training.show')->middleware(['can:tms-department-menu-access']);
                Route::get(
                    '/create',
                    'TrainingController@create'
                )->name('training.create')->middleware(['can:tms-department-menu-access']);
                Route::post('/', 'TrainingController@store')
                    ->name('training.store')->middleware(['can:tms-department-menu-access']);
                Route::get('{training}/edit', 'TrainingController@edit')
                    ->where('training', '[0-9]+')
                    ->name('training.edit')->middleware(['can:tms-department-menu-access']);
                Route::put(
                    '{training}',
                    'TrainingController@update'
                )->name('training.update')->middleware(['can:tms-department-menu-access']);
                Route::delete(
                    '{training_id}',
                    'TrainingController@destroy'
                )->name('training.delete')->middleware(['can:tms-department-menu-access']);
                // duration
                Route::prefix('{training}/duration')->group(
                    function () {
                        Route::get('/', 'TrainingDurationDeadlineController@show')
                            ->where('training', '[0-9]+')
                            ->name('training.durationDeadline.show')->middleware(['can:tms-department-menu-access']);
                        Route::get('/edit', 'TrainingDurationDeadlineController@edit')
                            ->name('training.durationDeadline.edit');
                        Route::put('/', 'TrainingDurationDeadlineController@update')
                            ->name('training.durationDeadline.update');
                    }
                );
                // category crud operation
                Route::prefix('category')->group(
                    function () {
                        Route::get('', 'TrainingCategoryController@index')
                            ->name('training.category.index')->middleware(['can:tms-department-menu-access']);
                        Route::get('{trainingCategory}', 'TrainingCategoryController@showTrainingCategory')
                            ->name('training-category-show')->middleware(['can:tms-department-menu-access']);
                        Route::post('store', 'TrainingCategoryController@store')
                            ->name('training.category.store')->middleware(['can:tms-department-menu-access']);
                        Route::get('edit/{trainingCateogry}', 'TrainingCategoryController@categoryEdit')
                            ->name('training-category-edit')->middleware(['can:tms-department-menu-access']);
                        Route::put('{trainingCateogry}', 'TrainingCategoryController@categoryUpdate')
                            ->name('training-category-update')->middleware(['can:tms-department-menu-access']);
                        Route::delete('{trainingCateogry}', 'TrainingCategoryController@destroy')
                            ->name('training-category-remove')->middleware(['can:tms-department-menu-access']);
                    }
                );
                // category
                Route::prefix('{training}/category')->group(
                    function () {
                        Route::get('/', 'TrainingCategoryController@show')
                            ->name('training.category.show')->middleware(['can:tms-department-menu-access']);
                        Route::get('edit', 'TrainingCategoryController@edit')
                            ->name('training.category.edit')->middleware(['can:tms-department-menu-access']);
                        Route::put('/', 'TrainingCategoryController@update')
                            ->name('training.category.update')->middleware(['can:tms-department-menu-access']);
                    }
                );

                // Training administration  [Another Access Point Without Course ]
                Route::prefix('{training}/administrations')->group(
                    function () {
                        Route::get('/', 'TrainingAdministrationController@show')
                            ->name('trainings.administrations.show')
                            ->where(['training' => '[0-9]+']);
                        Route::get('edit', 'TrainingAdministrationController@edit')
                            ->name('trainings.administrations.edit')
                            ->where(['training' => '[0-9]+']);
                        Route::put('/', 'TrainingAdministrationController@update')
                            ->name('trainings.administrations.update')
                            ->where(['training' => '[0-9]+']);
                    }
                );
                // Training Cost Segmentation
                Route::prefix('{training}/cost-segmentation')->group(
                    function () {
                        Route::get('/', 'TrainingCostSegmentationController@show')
                            ->name('trainings.cost-segmentation.show')
                            ->where(['training' => '[0-9]+']);
                        Route::get('edit', 'TrainingCostSegmentationController@edit')
                            ->name('trainings.cost-segmentation.edit')
                            ->where(['training' => '[0-9]+']);
                        Route::put('/', 'TrainingCostSegmentationController@update')
                            ->name('trainings.cost-segmentation.update')
                            ->where(['training' => '[0-9]+']);
                    }
                );

                Route::prefix('{training}/scheduled-sessions')->group(
                    function () {
                        Route::get('/', 'TrainingScheduleSessionController@index')
                            ->name('trainings.schedules.sessions.index')->middleware(
                                ['can:tms-department-course-administration-menu-access']
                            );
                    }
                );

                Route::prefix('{training}/course/{course}/certificates')->group(
                    function () {
                        Route::get('archive', 'TrainingCertificateArchiveController@show')
                            ->name('trainings.courses.certificates.archives.show');
                    }
                );

                // training speaker evaluation url's
                Route::middleware(['auth'])->prefix('speaker-evaluations')->group(
                    function () {
                        Route::get(
                            '/',
                            'TrainingSpeakerAssessmentController@index'
                        )
                            ->name('training.evaluate.index');
                        Route::get(
                            '/{courseId}/json',
                            'TrainingSpeakerAssessmentController@getJsonByCourse'
                        )->name('training.evaluate.course-json');

                        Route::get('{employee}/{sessionName}', 'TrainingSpeakerAssessmentController@show')
                            ->name('training.evaluate.show')
                            ->where(['employee' => '[0-9]+', 'sessionName' => '[0-9]+'])->middleware(
                                ['can:tms-menu-access']
                            );

                        Route::get(
                            'courses/{course}/speakers/{speaker}/charts',
                            'SpeakerAssessmentChartController@index'
                        )
                            ->name('speakers.evaluations.charts.index')
                            ->where('course', '[0-9]+')
                            ->where('speaker', '[0-9]+')
                            ->middleware(['checkCourseSpeaker:course,speaker']);
                        Route::get('sessions/{session}/charts', 'SpeakerAssessmentChartController@show')
                            ->name('speakers.evaluations.charts.show')
                            ->where('session', '[0-9]+')
                            ->middleware(['checkSessionSpeaker:session']);
                    }
                );

                // training course evaluation url's
                Route::middleware(['auth'])->prefix('course-evaluations')->group(
                    function () {
                        Route::get(
                            '/',
                            'TrainingCourseAssessmentController@index'
                        )->name('training.course.evaluate.index')
                            ->middleware(['can:tms-menu-access']);
                        Route::get(
                            '/question-setup',
                            'TrainingCourseAssessmentController@questionSetupForm'
                        )->name('training.course.evaluate.question.setup.form')
                            ->middleware(['can:tms-menu-access']);
                        Route::get(
                            '/store',
                            'TrainingCourseAssessmentController@questionStore'
                        )->name('training.course.evaluate.question.store')
                            ->middleware(['can:tms-menu-access']);
                        Route::get('{id}', 'TrainingCourseAssessmentController@show')
                            ->name('training.course.evaluate.show')
                            ->where(['employee' => '[0-9]+', 'sessionName' => '[0-9]+'])->middleware(
                                ['can:tms-menu-access']
                            );
                        Route::get('{id}/print', 'TrainingCourseAssessmentController@print')
                            ->name('training.course.evaluate.print')
                            ->where(['employee' => '[0-9]+', 'sessionName' => '[0-9]+'])->middleware(
                                ['can:tms-menu-access']
                            );
                    }
                );

                // training preparation
                Route::get(
                    'preparations',
                    'TrainingPreparationController@index'
                )->name('trainings.preparations.index')->middleware(['can:tms-department-menu-access']);
                Route::get('{training}/hostels/preparations/create', 'TrainingPreparationController@hostel')
                    ->name('trainings.hostels.preparations.create')->middleware(['can:tms-department-menu-access']);
                Route::get(
                    '{training}/cafeterias/preparations/create',
                    'TrainingPreparationController@cafeteria'
                )
                    ->name('trainings.cafeterias.preparations.create')->middleware(['can:tms-department-menu-access']);
                Route::get('{training}/venues/preparations/create', 'TrainingPreparationController@venue')
                    ->name('trainings.venues.preparations.create')->middleware(['can:tms-department-menu-access']);
                // course
                Route::middleware(['can:tms-department-course-administration-menu-access'])->prefix(
                    'course'
                )->group(
                    function () {
                        Route::get('/offline', 'TrainingCourseController@courseListOfflineTraining')->name('offline.courses');
                        Route::get('/online', 'TrainingCourseController@courseListOnlineTraining')->name('online.courses');
                    }
                );
                Route::middleware(['can:tms-department-course-administration-menu-access'])->prefix(
                    '{training}/courses'
                )->group(
                    function () {
                        Route::get('/', 'TrainingCourseController@index')->name('trainings.courses.index');
                        Route::get('/list', 'TrainingCourseController@trainingWiseCourse')->name('training.courses');
                        Route::get(
                            'create',
                            'TrainingCourseController@create'
                        )->name('trainings.courses.create');
                        Route::post('/', 'TrainingCourseController@store')->name('trainings.courses.store');
                        Route::get('{course}', 'TrainingCourseController@show')
                            ->name('trainings.courses.show')
                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                        Route::get('{course}/edit', 'TrainingCourseController@edit')
                            ->name('trainings.courses.edit')
                            ->middleware('checkCourseAdministrator')
                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                        Route::put('{course}', 'TrainingCourseController@update')
                            ->name('trainings.courses.update')
                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                        Route::middleware('checkCourseAdministrator')->prefix('{course}')->group(
                            function () {
                                // objective
                                Route::prefix('objectives')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseObjectiveController@show')
                                            ->name('trainings.courses.objectives.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseObjectiveController@edit')
                                            ->name('trainings.courses.objectives.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseObjectiveController@update')
                                            ->name('trainings.courses.objectives.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                Route::prefix('evaluation_result')->group(
                                    function () {
                                        Route::get(
                                            '/',
                                            'TrainingCourseAssessmentController@viewAssesmentResult'
                                        )
                                            ->name('trainings.courses.evaluation_result.show');
                                    }
                                );
                                // methods
                                Route::prefix('methods')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseMethodController@show')
                                            ->name('trainings.courses.methods.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseMethodController@edit')
                                            ->name('trainings.courses.methods.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseMethodController@update')
                                            ->name('trainings.courses.methods.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // rules and guidelines
                                Route::prefix('rules-guidelines')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseRuleGuidelineController@show')
                                            ->name('trainings.courses.rules-guidelines.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseRuleGuidelineController@edit')
                                            ->name('trainings.courses.rules-guidelines.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseRuleGuidelineController@update')
                                            ->name('trainings.courses.rules-guidelines.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // course payment type
                                Route::prefix('payment')->group(
                                    function () {
                                        Route::get('/create', 'TrainingCoursePaymentController@create')
                                            ->name('trainings.courses.payment.create');
                                        Route::post('/store', 'TrainingCoursePaymentController@store')
                                            ->name('trainings.courses.payment.store');
                                        Route::get('/', 'TrainingCoursePaymentController@show')
                                            ->name('trainings.courses.payment.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCoursePaymentController@edit')
                                            ->name('trainings.courses.payment.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCoursePaymentController@update')
                                            ->name('trainings.courses.payment.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // course payment type
                                Route::prefix('grade')->group(
                                    function () {
                                        Route::get('/create', 'TrainingCourseGradeController@create')
                                            ->name('trainings.courses.grade.create');
                                        Route::post('/store', 'TrainingCourseGradeController@store')
                                            ->name('trainings.courses.grade.store');
                                        Route::get('/', 'TrainingCourseGradeController@show')
                                            ->name('trainings.courses.grade.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseGradeController@edit')
                                            ->name('trainings.courses.grade.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseGradeController@update')
                                            ->name('trainings.courses.grade.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // break schedules
                                Route::prefix('breaks')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseBreakController@show')
                                            ->name('trainings.courses.breaks.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseBreakController@edit')
                                            ->name('trainings.courses.breaks.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseBreakController@update')
                                            ->name('trainings.courses.breaks.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // administration
                                Route::prefix('administrations')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseAdministrationController@show')
                                            ->name('trainings.courses.administrations.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseAdministrationController@edit')
                                            ->name('trainings.courses.administrations.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseAdministrationController@update')
                                            ->name('trainings.courses.administrations.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // Course Batches
                                Route::prefix('batches')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseBatchController@show')
                                            ->name('trainings.courses.batches.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseBatchController@edit')
                                            ->name('trainings.courses.batches.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseBatchController@update')
                                            ->name('trainings.courses.batches.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                    }
                                );
                                // batches hostel allocation
                                Route::prefix('batches/{batch}/rooms')->group(
                                    function () {
                                        Route::get('show', 'TrainingCourseBatchRoomController@show')
                                            ->name('trainings.courses.batches.rooms.show')
                                            ->where(
                                                [
                                                    'training' => '[0-9]+',
                                                    'course' => '[0-9]+',
                                                    'batch' => '[0-9]+'
                                                ]
                                            );
                                        Route::get('edit', 'TrainingCourseBatchRoomController@edit')
                                            ->name('trainings.courses.batches.rooms.edit')
                                            ->where(
                                                [
                                                    'training' => '[0-9]+',
                                                    'course' => '[0-9]+',
                                                    'batch' => '[0-9]+'
                                                ]
                                            );
                                        Route::put('rooms', 'TrainingCourseBatchRoomController@update')
                                            ->name('trainings.courses.batches.rooms.update')
                                            ->where(
                                                [
                                                    'training' => '[0-9]+',
                                                    'course' => '[0-9]+',
                                                    'batch' => '[0-9]+'
                                                ]
                                            );
                                    }
                                );
                                //Resources
                                Route::prefix('resources')->group(
                                    function () {
                                        Route::get('edit', 'TrainingCourseResourceController@edit')
                                            ->name('training.courses.resources.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('/', 'TrainingCourseResourceController@show')
                                            ->name('training.courses.resources.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseResourceController@update')
                                            ->name('training.courses.resources.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);

                                        Route::prefix('{resource}/scheduled-sessions')->group(
                                            function () {
                                                Route::get(
                                                    '/',
                                                    'TrainingCourseResourceScheduleSessionController@index'
                                                )
                                                    ->name('trainings.courses.resources.schedules.sessions.index');
                                            }
                                        );
                                    }
                                );

                                Route::prefix('marks')->group(
                                    function () {
                                        // Course Mark Allotment
                                        Route::prefix('allotments')->group(
                                            function () {
                                                Route::get('/', 'TrainingCourseMarkAllotmentController@show')
                                                    ->name('trainings.courses.marks.allotments.show')
                                                    ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                                Route::get('edit', 'TrainingCourseMarkAllotmentController@edit')
                                                    ->name('trainings.courses.marks.allotments.edit')
                                                    ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                                Route::put('/', 'TrainingCourseMarkAllotmentController@update')
                                                    ->name('trainings.courses.marks.allotments.update')
                                                    ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                            }
                                        );
                                        // trainee mark value
                                        Route::prefix('values')->group(
                                            function () {
                                                Route::get('/', 'TraineeCourseMarkValueController@show')
                                                    ->name('trainees.courses.marks.values.show')
                                                    ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);

                                                Route::put(
                                                    'marks/values',
                                                    'TraineeCourseMarkValueController@update'
                                                )
                                                    ->name('trainees.courses.marks.values.update')
                                                    ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);

                                                Route::get(
                                                    'sample-file',
                                                    'TraineeCourseMarkValueController@generateSample'
                                                )
                                                    ->name('trainees.courses.marks.sample.file')
                                                    ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                            }
                                        );
                                    }
                                );
                                // trainee mark value insertion
                                Route::get(
                                    'trainees/{trainee}/marks/values/edit',
                                    'TraineeCourseMarkValueController@edit'
                                )
                                    ->name('trainees.courses.marks.values.edit')
                                    ->where([
                                        'training' => '[0-9]+',
                                        'course' => '[0-9]+',
                                        'trainee' => '[0-9]+'
                                    ]);
                                Route::get(
                                    'trainees/{trainee}/marks/values/sheet',
                                    'TraineeCourseMarkValueController@showMarkValueIndividual'
                                )
                                    ->name('trainees.courses.marks.values.sheet')
                                    ->where([
                                        'training' => '[0-9]+',
                                        'course' => '[0-9]+',
                                        'trainee' => '[0-9]+'
                                    ]);

                                // Training Course Modules
                                Route::prefix('modules')->group(
                                    function () {
                                        Route::get('/', 'TrainingCourseModuleController@show')
                                            ->name('trainings.courses.modules.show')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::get('edit', 'TrainingCourseModuleController@edit')
                                            ->name('trainings.courses.modules.edit')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);
                                        Route::put('/', 'TrainingCourseModuleController@update')
                                            ->name('trainings.courses.modules.update')
                                            ->where(['training' => '[0-9]+', 'course' => '[0-9]+']);

                                        // Training Course Module Sessions
                                        Route::prefix('{module}/sessions')->group(
                                            function () {
                                                Route::get('/', 'TrainingCourseModuleSessionController@show')
                                                    ->name('trainings.courses.modules.sessions.show')
                                                    ->where(
                                                        [
                                                            'training' => '[0-9]+',
                                                            'course' => '[0-9]+',
                                                            'module' => '[0-9]+'
                                                        ]
                                                    );
                                                Route::get('edit', 'TrainingCourseModuleSessionController@edit')
                                                    ->name('trainings.courses.modules.sessions.edit')
                                                    ->where(
                                                        [
                                                            'training' => '[0-9]+',
                                                            'course' => '[0-9]+',
                                                            'module' => '[0-9]+'
                                                        ]
                                                    );
                                                Route::put('/', 'TrainingCourseModuleSessionController@update')
                                                    ->name('trainings.courses.modules.sessions.update')
                                                    ->where(
                                                        [
                                                            'training' => '[0-9]+',
                                                            'course' => '[0-9]+',
                                                            'module' => '[0-9]+'
                                                        ]
                                                    );

                                                // Training Course Module Session Schedule
                                                //                        Route::prefix('scheduled')->group(function () {
                                                //                            Route::get('/', function () {
                                                //                                echo "Ta da...";
                                                //                            })->name('trainings.courses.modules.sessions.schedules.index');
                                                //                        });

                                                // Training Course Module Batch Session Schedule

                                                Route::prefix('batch/{batch}/schedule')->group(
                                                    function () {
                                                        Route::get(
                                                            'edit',
                                                            'TrainingCourseModuleBatchSessionScheduleController@edit'
                                                        )
                                                            ->name(
                                                                'trainings.courses.modules.batches.sessions.schedules.edit'
                                                            )
                                                            ->where(
                                                                [
                                                                    'training' => '[0-9]+',
                                                                    'course' => '[0-9]+',
                                                                    'module' => '[0-9]+',
                                                                    'batch' => '[0-9]+'
                                                                ]
                                                            );
                                                        Route::put(
                                                            '/',
                                                            'TrainingCourseModuleBatchSessionScheduleController@update'
                                                        )
                                                            ->name(
                                                                'trainings.courses.modules.batches.sessions.schedules.update'
                                                            )
                                                            ->where(
                                                                [
                                                                    'training' => '[0-9]+',
                                                                    'course' => '[0-9]+',
                                                                    'module' => '[0-9]+',
                                                                    'batch' => '[0-9]+'
                                                                ]
                                                            );
                                                        Route::get(
                                                            'show',
                                                            'TrainingCourseModuleBatchSessionScheduleController@show'
                                                        )
                                                            ->name(
                                                                'trainings.courses.modules.batches.sessions.schedules.show'
                                                            )
                                                            ->where(
                                                                [
                                                                    'training' => '[0-9]+',
                                                                    'course' => '[0-9]+',
                                                                    'module' => '[0-9]+',
                                                                    'batch' => '[0-9]+'
                                                                ]
                                                            );
                                                        // notify trainees
                                                        Route::get(
                                                            'notify',
                                                            'TrainingCourseModuleBatchSessionScheduleController@notify'
                                                        )
                                                            ->name('trainings.courses.modules.batches.sessions.schedules.notify');
                                                    }
                                                );
                                            }
                                        );
                                    }
                                );

                                // Training Course Evaluation
                                Route::prefix('evaluation')->group(
                                    function () {
                                        Route::prefix('settings')->group(
                                            function () {
                                                Route::get('', 'CourseEvaluationSettingController@show')
                                                    ->name('trainings.courses.evaluations.settings.show');
                                                Route::get('/edit', 'CourseEvaluationSettingController@edit')
                                                    ->name('trainings.courses.evaluations.settings.edit');
                                                Route::put('', 'CourseEvaluationSettingController@update')
                                                    ->name('trainings.courses.evaluations.settings.update');
                                            }
                                        );
                                    }
                                );
                            }
                        );
                    }
                );
                // hostel calender routes
                Route::prefix('hostels/calenders')->group(
                    function () {
                        // training hostels calendars
                        Route::get('/', 'TrainingHostelCalendarController@show')
                            ->name('trainings.hostels.calendars.show');

                        Route::get('/{training}/data', 'TrainingHostelCalendarController@getData')
                            ->name('trainings.hostels.calendars.data');
                    }
                );

                // training cafeterias calendars
                Route::get('hostels/cafeterias', 'TrainingCafeteriaCalendarController@show')
                    ->name('trainings.cafeterias.calendars.show');
            }
        );

        Route::middleware(['auth', 'can:tms-access-medical'])->group(
            function () {
                Route::get('medical/trainee', 'TraineeController@index')
                    ->name('medical.trainee.index');
                Route::get('medical/trainee/{trainingId?}', 'TraineeController@index')
                    ->name('medical.trainee.search.index');
                Route::get('medical/show/{trainee}', 'TraineeController@show')
                    ->name('medical.trainee.show');
                Route::get('medical/show/{trainee}/general-info', 'TraineeGeneralInfoController@show')
                    ->name('medical.trainee.general-info.show');
                Route::get('medical/show/{trainee}/education-info', 'TraineeEducationInfoController@show')
                    ->name('medical.trainee.education-info.show');
                Route::get('medical/show/{trainee}/trainee-info', 'TraineeTypeController@show')
                    ->name('medical.trainee.trainee-type.show');
                Route::get('medical/show/{trainee}/service-info', 'TraineeServiceInfoController@show')
                    ->name('medical.trainee.service.show');
                Route::get('medical/show/{trainee}/emergency-contact', 'TraineeEmergencyContactController@show')
                    ->name('medical.trainee.emergency-contact.show');
                Route::get('medical/show/{trainee}/health-reports', 'TraineeHealthExamReportController@show')
                    ->name('medical.trainee.health-reports.show');
                Route::get('edit/{trainee}/health-reports', 'TraineeHealthExamReportController@edit')
                    ->name('trainee.edit.healthExam');
                Route::put('/edit/health-reports/{trainee}', 'TraineeHealthExamReportController@update')
                    ->name('trainee.health-reports.update');
            }
        );
        // Route group for all request regarding trainee
        Route::middleware(
            [
                'auth',
                'can:tms-department-course-administration-menu-access'
            ]
        )->prefix('trainee')->group(
            function () {
                Route::get('/approve', 'TraineeController@onlineEnrollTraineeList')->name('online.enroll.trainee.list');
                Route::get('/{trainingId?}', 'TraineeController@index')->name('trainee.index')
                    ->middleware(['checkTrainingRegistrationDate:true,trainingId']);
                // old-trainee-import code
                Route::get('/import/to/{training_id}', 'TraineeController@import')->name('trainee.import');
                Route::post(
                    '/import/to/{training_id}',
                    'TraineeController@import'
                )->name('trainee.saveImported');
                Route::post('/import/store/{training_id}', 'TraineeController@storeImported');
                // improved import code
                Route::get(
                    '/import/download-sample',
                    'TraineeImportController@downloadSample'
                )->name('trainee.import.download-sample');
                Route::get(
                    '/import/trainee/show/{training}',
                    'TraineeImportController@index'
                )->name('trainee.import.index');
                Route::post(
                    '/import/trainee/show/{training}',
                    'TraineeImportController@show'
                )->name('trainee.import.show-data');
                Route::post(
                    '/import/trainee/{training}',
                    'TraineeImportController@store'
                )->name('trainee.import.store');
                // mark-import
                Route::post(
                    '/import/marks/{courseID}',
                    'TraineeCourseMarkValueController@import'
                )->name('trainees.courses.marks.values.import');
                //Trainee Create
                Route::get('/add/to/{training}', 'TraineeController@create')
                    ->name('trainee.add');
                Route::get('{trainee}/general-info', 'TraineeGeneralInfoController@create')
                    ->name('trainee.add.general-info');
                Route::get('{trainee}/education-info', 'TraineeEducationInfoController@create')
                    ->name('trainee.add.education-info');
                Route::get('{trainee}/trainee-type', 'TraineeTypeController@create')
                    ->name('trainee.add.trainee-type');
                Route::get('{trainee}/service-info', 'TraineeServiceInfoController@create')
                    ->name('trainee.add.service-info');
                Route::get('{trainee}/emergency-contact', 'TraineeEmergencyContactController@create')
                    ->name('trainee.add.emergency-contact');
                Route::get('{trainee}/health-reports', 'TraineeHealthExamReportController@create')
                    ->name('trainee.add.health-reports');

                Route::post('/add/to/{training}', 'TraineeController@store')
                    ->name('trainee.store');
                Route::post('{trainee}/general-info', 'TraineeGeneralInfoController@store')
                    ->name('trainee.general-info.store');
                Route::post('{trainee}/education-info', 'TraineeEducationInfoController@store')
                    ->name('trainee.education-info.store');
                Route::post('{trainee}/trainee-type', 'TraineeTypeController@store')
                    ->name('trainee.trainee-type.store');
                Route::post('{trainee}/service-info', 'TraineeServiceInfoController@store')
                    ->name('trainee.service.store');
                Route::post('{trainee}/emergency-contact', 'TraineeEmergencyContactController@store')
                    ->name('trainee.contact.store');
                Route::post('{trainee}/health-reports', 'TraineeHealthExamReportController@store')
                    ->name('trainee.health-reports.store');
                // Trainee Edit Routes
                Route::get('/edit/{trainee}', 'TraineeController@edit')
                    ->name('trainee.edit');
                Route::get('edit/{trainee}/general-information', 'TraineeGeneralInfoController@edit')
                    ->name('trainee.edit.general-info');
                Route::get('edit/{trainee}/education-information', 'TraineeEducationInfoController@edit')
                    ->name('trainee.edit.education-info');
                Route::get('edit/{trainee}/trainee-type', 'TraineeTypeController@edit')
                    ->name('trainee.edit.trainee-type');
                Route::get('edit/{trainee}/service-info', 'TraineeServiceInfoController@edit')
                    ->name('trainee.edit.service-info');
                Route::get('edit/{trainee}/emergency-contact', 'TraineeEmergencyContactController@edit')
                    ->name('trainee.edit.emergency-contact');
                // Route::get('edit/{trainee}/health-reports', 'TraineeHealthExamReportController@edit')
                //     ->name('trainee.edit.healthExam');
                //Trainee Update Routes
                Route::put('/edit/{trainee}', 'TraineeController@update')
                    ->name('trainee.update');
                Route::put('/edit/general-info/{trainee}', 'TraineeGeneralInfoController@update')
                    ->name('trainee.general-info.update');
                Route::put('/edit/education-info/{trainee}', 'TraineeEducationInfoController@update')
                    ->name('trainee.education-info.update');
                Route::put('/edit/trainee-type/{trainee}', 'TraineeTypeController@update')
                    ->name('trainee.trainee-type.update');
                Route::put('/edit/service/{trainee}', 'TraineeServiceInfoController@update')
                    ->name('trainee.service.update');
                Route::put('/edit/contact/{trainee}', 'TraineeEmergencyContactController@update')
                    ->name('trainee.contact.update');
                // Route::put('/edit/health-reports/{trainee}', 'TraineeHealthExamReportController@update')
                //     ->name('trainee.health-reports.update');
                Route::get('/show/{trainee}', 'TraineeController@show')
                    ->name('trainee.show');
                Route::get('/approve/{trainee}', 'TraineeController@onlineEnrolledTraineeApprove')
                    ->name('online.enroll.trainee.approve');
                Route::get('/reject/{trainee}', 'TraineeController@onlineEnrolledTraineeReject')
                    ->name('online.enroll.trainee.reject');
                Route::get('show/{trainee}/general-info', 'TraineeGeneralInfoController@show')
                    ->name('trainee.general-info.show');
                Route::get('show/{trainee}/education-info', 'TraineeEducationInfoController@show')
                    ->name('trainee.education-info.show');
                Route::get('show/{trainee}/trainee-type', 'TraineeTypeController@show')
                    ->name('trainee.trainee-type.show');
                Route::get('show/{trainee}/service-info', 'TraineeServiceInfoController@show')
                    ->name('trainee.service.show');
                Route::get('show/{trainee}/emergency-contact', 'TraineeEmergencyContactController@show')
                    ->name('trainee.emergency-contact.show');
                Route::get('show/{trainee}/health-reports', 'TraineeHealthExamReportController@show')
                    ->name('trainee.health-reports.show');

                Route::delete('/delete/{trainee_id}', 'TraineeController@destroy')->name('trainee.delete');
                //print routes
                Route::get('/{trainee}/print', 'TraineeController@print')->name('trainees.print');
                // trainee certificate
                Route::get(
                    '{trainee}/courses/{course}/certificates/{local}/show',
                    'TraineeCertificateController@show'
                )
                    ->name('trainees.certificates.show');
            }
        );

        // Training Organization
        Route::middleware(['auth', 'can:tms-department-menu-access'])->prefix('organization')->group(
            function () {
                Route::get('/', 'TrainingOrganizationController@index')
                    ->name('organization.index');
                Route::get('/create', 'TrainingOrganizationController@create')
                    ->name('organization.create');
                Route::post('/', 'TrainingOrganizationController@store')
                    ->name('trainingOrganization.store');
                Route::get('/{trainingOrganization}', 'TrainingOrganizationController@show')
                    ->name('trainingOrganization.show');
                Route::get('{trainingOrganization}/edit', 'TrainingOrganizationController@edit')
                    ->name('trainingOrganization.edit');
                Route::put('{trainingOrganization}', 'TrainingOrganizationController@update')
                    ->name('trainingOrganization.update');
            }
        );

        //Annual Training Notification to Organization
        Route::middleware(
            [
                'auth',
                'can:tms-department-menu-access'
            ]
        )->prefix('annual-training-notification')->group(function () {
            Route::get('/create', 'AnnualTrainingNotificationController@create')
                ->name('annual-training-notification.create');
            Route::get('/', 'AnnualTrainingNotificationController@index')
                ->name('annual-training-notification.index');
            Route::get('/{id}', 'AnnualTrainingNotificationController@show')
                ->name('annual-training-notification.show');
            Route::get('/{annualTrainingNotification}/print', 'AnnualTrainingNotificationController@print')
                ->name('annual-training-notification.print');
            Route::get('/{id}/edit', 'AnnualTrainingNotificationController@edit')
                ->name('annual-training-notification.edit');
            Route::put('/{id}', 'AnnualTrainingNotificationController@update')
                ->name('annual-training-notification.update');
            Route::post(
                '/',
                'AnnualTrainingNotificationController@store'
            )->name('annual-training-notification.store');
            Route::get(
                '/{notificationId}/download-attachment',
                'AnnualTrainingNotificationController@downloadAttachment'
            )
                ->name('annual-training-notification.download');
        });

        // Training Committee
        Route::middleware(['auth', 'can:tms-department-menu-access'])->prefix('training-committee')->group(
            function () {
                Route::get('/create', 'TrainingCommitteeController@create')->name('training-committee.create');
            }
        );

        // Training Course Module Session Schedule
        Route::middleware(['auth', 'canAccessTMS'])->prefix('training-course-scheduled-sessions')->group(
            function () {
                Route::get(
                    '/',
                    'TrainingCourseModuleScheduleSessionController@index'
                )->name('trainings.courses.modules.sessions.schedules.index');
                Route::prefix('{tCMBSS}')->group(
                    function () {
                        Route::get(
                            'trainees',
                            function ($tCMBSS) {
                                echo "Ta-da";
                            }
                        )
                            ->name('trainings.courses.modules.sessions.schedules.trainee.index');
                    }
                );
            }
        );

        // Training Course Module Session Evaluation
        Route::middleware(['auth', 'can:tms-menu-access'])->prefix('evaluations-trainees')->group(
            function () {

                Route::get(
                    'course',
                    'TrainingCourseModuleScheduleSessionController@courseEvaluation'
                )->name('trainings.courses.modules.sessions.course_evaluations');

                // new routes for speaker-evaluation-trainee-who-did-not-evaluate
                //                Route::get(
                //                    '/',
                //                    'TrainingCourseModuleScheduleSessionController@evaluations'
                //                )->name('trainings.courses.modules.sessions.evaluations');         commented old method

                Route::get(
                    '/',
                    'TraineeWhoDidNotSubmitSpeakerEvaluationController@index'
                )->name('trainings.courses.modules.sessions.evaluations');
                Route::get(
                    '{trainingCourseId}/load-data',
                    'TraineeWhoDidNotSubmitSpeakerEvaluationController@loadData'
                )->name('trainings.courses.modules.sessions.evaluations.load-data');
            }
        );

        // Route::middleware(['auth', 'can:tms-department-menu-access'])->prefix('venue')->group(
        //     function () {
        //         Route::get('/', 'TrainingVenueController@index')->name('venue.index');
        //         Route::get('/create', 'TrainingVenueController@create')->name('venue.create');
        //         Route::post('/store', 'TrainingVenueController@store')->name('venue.store');
        //         Route::get('/show/{venueid}', 'TrainingVenueController@show')->name('venue.show');
        //         Route::get('/edit/{venueid}', 'TrainingVenueController@edit')->name('venue.edit');
        //         Route::put('/update/{venueid}', 'TrainingVenueController@update')->name('venue.update');
        //         Route::delete('/destroy/{venueid}', 'TrainingVenueController@destroy')->name('venue.destroy');
        //     }
        // );
        Route::middleware(['auth', 'can:tms-department-menu-access'])->prefix('training')->group(
            function () {
                Route::resource('venue', 'TrainingVenueController');
                Route::resource('expense-type', 'TrainingExpenseTypeController');
            }
        );

        // TMS Trainee type
        Route::middleware(['auth', 'can:tms-department-menu-access'])->prefix('trainee-type')->group(
            function () {
                Route::get('/', 'TrainingParticipantTypeController@index')->name('trainee-type.index');
                Route::get('/create', 'TrainingParticipantTypeController@create')->name('trainee-type.create');
                Route::post('/store', 'TrainingParticipantTypeController@store')->name('trainee-type.store');
                Route::get('show/{traineetypeid}', 'TrainingParticipantTypeController@show')->name('trainee-type.show');
                Route::get(
                    '/edit/{traineetypeid}',
                    'TrainingParticipantTypeController@edit'
                )->name('trainee-type.edit');
                Route::put(
                    '/update/{traineetypeid}',
                    'TrainingParticipantTypeController@update'
                )->name('trainee-type.update');
                Route::delete('/{traineetypeid}', 'TrainingParticipantTypeController@destroy')->name('trainee-type.delete');
            }
        );

        // TMS Budget and Accounting related resources

        Route::resources(
            [
                'tms-sectors' => 'TmsSectorController',
                'tms-budgets' => 'TmsBudgetController'
            ]
        );

        // TMS Accounts Report related routes
        Route::prefix('tms-budgets')->group(function () {
            Route::get(
                '/{tmsBudget}/print/{type?}',
                'TmsBudgetController@print'
            )->name('tms.tms-budgets.print');
        });

        // TMS Accounts Report related routes
        Route::prefix('accounts-reports')->group(function () {
            Route::get('/', 'TmsAccountsReportController@index')->name('tms-accounts-reports.index');
            Route::get('/show/{trainingId}/{reportType}', 'TmsAccountsReportController@show')
                ->name('tms-accounts-reports.show');
        });

        // Tms Accounts Related Routes
        Route::middleware(
            [
                'auth',
            ]
        )->prefix('journal-entries')->group(function () {
            Route::get('/create', 'TmsJournalEntryController@create')->name('tms.journal-entries.create');
            Route::get('/', 'TmsJournalEntryController@index')->name('tms.journal-entries.index');
            Route::get('/{tmsJournalEntry}', 'TmsJournalEntryController@show')->name('tms.journal-entries.show');
            Route::get('/{tmsJournalEntry}/edit', 'TmsJournalEntryController@edit')->name('tms.journal-entries.edit');
            Route::put('/{tmsJournalEntry}', 'TmsJournalEntryController@update')->name('tms.journal-entries.update');
            Route::get(
                '/{tmsJournalEntry}/status/{status}',
                'TmsJournalEntryController@changeStatus'
            )->name('tms.journal-entries.change-status');
            Route::post('/', 'TmsJournalEntryController@store')->name('tms.journal-entries.store');
        });

        // Tms Accounts Related Routes
        Route::middleware(
            [
                'auth',
            ]
        )->prefix('advance-payments')->group(function () {
            Route::get('/create', 'TmsAdvancePaymentController@create')->name('tms.advance-payments.create');
            Route::get('/', 'TmsAdvancePaymentController@index')->name('tms.advance-payments.index');
            Route::get(
                '/{tmsAdvancePayment}',
                'TmsAdvancePaymentController@show'
            )->name('tms.advance-payments.show');
            Route::post('/', 'TmsAdvancePaymentController@store')->name('tms.advance-payments.store');
        });
        // Tms Hostel Booking Request Related URL's
        Route::middleware(
            [
                'auth',
            ]
        )->prefix('hostel-booking-requests')->group(function () {
            Route::get(
                '/create',
                'TmsHostelBookingRequestController@create'
            )->name('tms.hostel-booking-requests.create');
            Route::get(
                '/{id}/edit',
                'TmsHostelBookingRequestController@edit'
            )->name('tms.hostel-booking-requests.edit');
            Route::put('/', 'TmsHostelBookingRequestController@update')
                ->name('tms.hostel-booking-requests.update');
            Route::post(
                '/',
                'TmsHostelBookingRequestController@store'
            )->name('tms.hostel-booking-requests.store');
        });

        // Tms annual Training Notification Response Related Url's
        Route::middleware(
            [
                'auth',
            ]
        )->prefix('annual-training-notification/response/')->group(function () {
            Route::get(
                '{annualTrainingNotification}/user/{user}',
                'AnnualTrainingNotificationUserResponseController@edit'
            )
                ->name('tms.annual-training-notification.response.user.create');
            Route::post(
                'user/',
                'AnnualTrainingNotificationUserResponseController@store'
            )
                ->name('tms.annual-training-notification.response.user.store');
        });

        // Tms Code Settings Url's
        Route::middleware(
            [
                'auth',
            ]
        )->prefix('code-settings/')->group(function () {
            Route::get(
                '/create',
                'TmsCodeSettingController@create'
            )->name('tms.code-setting.create');
            Route::get(
                '/',
                'TmsCodeSettingController@index'
            )->name('tms.code-setting.index');
            Route::get(
                '/edit',
                'TmsCodeSettingController@edit'
            )->name('tms.code-setting.edit');
            Route::put('/', 'TmsCodeSettingController@update')
                ->name('tms.code-setting.update');
            Route::post('/', 'TmsCodeSettingController@store')->name('tms.code-setting.store');
        });
    }
);
