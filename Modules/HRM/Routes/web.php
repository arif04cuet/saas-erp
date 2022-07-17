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
//Route::middleware( 'auth:web' )->group( function () {
Route::middleware(['auth', 'can:guest_access'])->prefix('hrm')->group(function () {

    Route::get('/', 'HRMController@index')->name('hrm-dashboard');
    Route::get('/show', 'HRMController@show'); // Temporary & Demo
    Route::get('/employee-import', 'EmployeeController@importEmployee')->name('employee.import');
    Route::POST('/employee-information-store', 'EmployeeController@importEmployeeInformationStore')->name('employee-information-store');

    Route::prefix('employee')->group(function () {

        Route::post('general-info', 'EmployeeController@store')->name('employee.store.general-info');
        Route::get('personal-info', 'EmployeeController@personalInformationIndex')->name('employee.get.personal-info');

        Route::post('personal-info', 'EmployeePersonalInfoController@store')->name('employee.store.personal-info');
        Route::put('update-personal-info/{id}', 'EmployeePersonalInfoController@update')->name('update.employee.personal-info');

        Route::post('spouse-children-info', 'EmployeeSpouseChildrenController@store')->name('employee.store.spouse-children-info');
        Route::put('update-spouse-children-info/{id}', 'EmployeeSpouseChildrenController@update')->name('employee.update-spouse-children-info');

        Route::post('education-info', 'EmployeeEducationController@store')->name('store.employee.education-info');
        Route::put('update-education-info/{id}', 'EmployeeEducationController@update')->name('employee.update-education-info');

        Route::post('training-info', 'EmployeeTrainingController@store')->name('store.employee.training-info');
        Route::put('update-training-info/{id}', 'EmployeeTrainingController@update')->name('employee.update-training-info');

        Route::post('publication-info', 'EmployeePublicationController@store')->name('store.employee.publication-info');
        Route::put('update-publication-info/{id}', 'EmployeePublicationController@update');


        Route::post('research-info', 'EmployeeResearchController@store');
        Route::put('update-research-info/{id}', 'EmployeeResearchController@update');

        Route::post('/create-interest-info', 'EmployeeInterestController@store')->name('store.employee.interest-info');
        Route::put('/update-interest-info/{id}', 'EmployeeInterestController@update')->name('employee.update-interest-info');

        //ajax routes for employee - required in accounting-payslip
        // prefixing with ajax so it does not conflict with any
        // other routes
        Route::get(
            'ajax/contract/{employee}',
            'EmployeeController@getEmployeeContract'
        )->name('ajax.employee.contract');
        Route::get(
            'ajax/salary-structure/{employee}',
            'EmployeeController@getEmployeeStructure'
        )->name('ajax.employee.salary.structure');
        Route::get('ajax/{employee}', 'EmployeeController@getEmployee')->name('ajax.employee');
    });

    // Routes for Employee Leave
    Route::prefix('leaves')->group(function () {
        Route::get('/', 'EmployeeLeaveController@index')->name('leaves.index');
        Route::get('/create', 'EmployeeLeaveController@create')->name('leaves.create');
        Route::get('{id}/cancel', 'EmployeeLeaveController@cancel')->name('leaves.cancel');
        Route::post('/', 'EmployeeLeaveController@store')->name('leaves.store');
        Route::get('{leaveRequest}', 'EmployeeLeaveController@show')->name('leaves.show');
        // leave request edit by authority
        Route::middleware(['leaveRequestEditPermission'])
            ->prefix('{leaveRequest}')
            ->where(['leaveRequest' => '[0-9]+'])
            ->group(function () {
                Route::get('edit', 'EmployeeLeaveController@edit')->name('leaves.edit');
                Route::put('/', 'EmployeeLeaveController@update')->name('leaves.update');
            });

        // Workflow
        Route::prefix('workflow')->group(function () {
            Route::get('{leaveRequest}', 'EmployeeLeaveWorkflowController@show')
                ->name('hrm-leave-request.workflow.show')
                ->middleware(['leaveRequestRecipient']);
            Route::put('/', 'EmployeeLeaveWorkflowController@update')
                ->name('hrm-leave-request.workflow.update');
        });

        // Ajax
        Route::get('/check-leave-exist/{startDate}/{endDate}', 'EmployeeLeaveController@checkLeaveByDate')
            ->name('check-leaves.index');

        Route::get('{leaveTypeId}/balance', 'EmployeeLeaveController@checkLeaveBalance')->name('leaves.balance');

        Route::get('edit_employee_leave/{id}', 'EmployeeLeaveController@editEmployeeLeave')->name('leaves.edit_employee_leave');
        Route::post('update_employee_leave', 'EmployeeLeaveController@updateEmployeeLeave')->name('leaves.update_employee_leave');
    });
    Route::get('/import', 'EmployeeLeaveController@importConsumedLeave')->name('consumed-leave-import');
    Route::POST('/consumed-leave-store', 'EmployeeLeaveController@importConsumedLeaveStore')->name('consumed-leave-store');

    // Leave Type Routes
    Route::prefix('leave-types')->group(function () {
        Route::get('/', 'LeaveTypeController@index')->name('leave-types.index');
        Route::get('/{id}/edit', 'LeaveTypeController@edit')->name('leave-types.edit');
        Route::put('/{id}/update', 'LeaveTypeController@update')->name('leave-types.update');
        Route::get('{leaveRequest}', 'LeaveTypeController@show')->name('leave-types.show');
    });

    // Leave Balance Routes
    Route::prefix('leave-balances')->group(function () {
        Route::get('/', 'LeaveBalanceController@index')->name('leave-balances.index');
        Route::get('{employeeId}', 'LeaveBalanceController@show')->name('leave-balances.show');
    });

    // Routes for Employee Loan
    Route::prefix('loans')->group(function () {
        Route::get('/', 'EmployeeLoanController@index')->name('employee-loans.index');
        Route::get('/loans', 'EmployeeLoanController@loans')->name('employee-loans.loans');
        Route::get('/create', 'EmployeeLoanController@create')->name('employee-loans.create');
        Route::post('/store', 'EmployeeLoanController@store')->name('employee-loans.store');
        Route::get('/{id}', 'EmployeeLoanController@show')->name('employee-loans.show');
        Route::get('/{id}/download', 'EmployeeLoanController@attachment')->name('employee-loans.attachment');
        Route::get('/edit', 'EmployeeLoanController@edit')->name('employee-loans.edit');
        Route::put('/update', 'EmployeeLoanController@udpate')->name('employee-loans.update');
        Route::get('{id}/approve', 'EmployeeLoanController@approve')->name('employee-loans.approve');
        Route::post('{id}/approval', 'EmployeeLoanController@approval')->name('employee-loans.approval');
    });

    // Routes for Employee Loan Circular
    Route::prefix('loan-circulars')->group(function () {
        Route::get('/', 'EmployeeLoanCircularController@index')->name('loan-circulars.index');
        Route::get('/create', 'EmployeeLoanCircularController@create')->name('loan-circulars.create');
        Route::post('/store', 'EmployeeLoanCircularController@store')->name('loan-circulars.store');
        Route::get('/{id}', 'EmployeeLoanCircularController@show')->name('loan-circulars.show');
        Route::get('{id}/edit', 'EmployeeLoanCircularController@edit')->name('loan-circulars.edit');
        Route::put('/update/{id}', 'EmployeeLoanCircularController@update')->name('loan-circulars.update');
    });

    // Routes for Employee HRM Training
    Route::prefix('training')->group(function () {
        Route::get('/', 'HRMTrainingController@create')->name('employee-training.apply');
        Route::post('/', 'HRMTrainingController@store')->name('employee-training.store');
        Route::get('/list/{trainingId?}', 'HRMTrainingController@index')->name('employee-training.list');
    });

    // Routes for Employee Attendance
    Route::prefix('attendance')->group(function () {
        Route::get('/', 'EmployeeAttendanceController@index')->name('employee-attendance.index');
        Route::post('/', 'EmployeeAttendanceController@store')->name('employee-training.store');
    });

    // Routes for Employee Punishment
    Route::prefix('punishment')->group(function () {
        Route::get('/list', 'EmployeePunishmentController@index')->name('employee-punishment.list');
        Route::get('/show/{punishmentId}', 'EmployeePunishmentController@show')->name('employee-punishment.show');
        Route::get('/create', 'EmployeePunishmentController@create')->name('employee-punishment.create');
        Route::post('/create', 'EmployeePunishmentController@store')->name('employee-punishment.store');
    });

    #---------------- House Rent Urls-----------------------------#
    Route::prefix('house-rent')->group(function () {
        Route::get('/circulate-house', 'HouseRentController@index');
        Route::get('/apply-for-house', 'HouseRentController@applyForHouse');
        Route::get('/show-house', 'HouseRentController@showHouse');
        Route::get('/approve-house-rent', 'HouseRentController@approveHouseRent');
        Route::get('/apply', 'HouseRentController@showApplyForm');
        Route::get('/applications', 'HouseRentController@showAllApplications');
    });
    #--------------- // House Rent Urls ---------------------------------

    #---------------- Notes Urls-----------------------------#
    Route::prefix('notes')->group(function () {
        Route::get('/', 'NoteController@index')->name('note.index');
        Route::get('/create', 'NoteController@create')->name('note.create');
        Route::post('/', 'NoteController@store')->name('note.store');
        Route::get('/{note}', 'NoteController@show')->name('note.show');
        Route::delete('/{note}', 'NoteController@destroy')->name('note.destroy');
        Route::get('edit/{note}', 'NoteController@edit')->name('note.edit');
    });
    #--------------- // Note Urls ---------------------------------

    #---------------- Appraisal Urls-----------------------------#
    Route::prefix('appraisal')->group(function () {
        Route::get('/', 'AppraisalController@index')->name('appraisals.index');
        Route::post('/', 'AppraisalController@store')->name('appraisals.store');
        Route::get('/{class}/create', 'AppraisalController@create')->name('appraisal.create')
            ->where('class', 'first|second|third|fourth');
        Route::get('/{appraisal}/show', 'AppraisalController@show')->name('appraisals.show')
            ->middleware(['completedAppraisalRecipient']);
        Route::get('/{appraisal}/edit', 'AppraisalController@edit')->name('appraisals.edit')
            ->middleware(['appraisalWorkflowRecipient']);
        Route::post('{appraisal}/update', 'AppraisalController@update')->name('appraisals.update');

        // Appraisal Invitation
        Route::prefix('invitations')->group(function () {
            $AppraisalInvitationController = 'AppraisalInvitationController';
            $appraisalInvitationRouteName = 'appraisal.invitation';
            Route::get('/', "$AppraisalInvitationController@index")->name("$appraisalInvitationRouteName.index");
            Route::get(
                '/create',
                "$AppraisalInvitationController@create"
            )->name("$appraisalInvitationRouteName.create");
            Route::post('/', "$AppraisalInvitationController@store")->name("$appraisalInvitationRouteName.store");
            Route::get(
                '{appraisalInvitation}',
                "$AppraisalInvitationController@show"
            )->name("$appraisalInvitationRouteName.show");
        });


        Route::get('getEmployees/{department_id}', 'AppraisalController@getEmployeesByDepartmentId')
            ->name('appraisals.employeesByDepartment');

        // appraisal settings
        Route::prefix('settings')->group(function () {
            $AppraisalSettingController = 'AppraisalSettingController';
            $appraisalSettingRouteName = 'appraisals.settings';
            Route::get('/', "$AppraisalSettingController@index")->name("$appraisalSettingRouteName.index");
            Route::get('create', "$AppraisalSettingController@create")->name("$appraisalSettingRouteName.create");
            Route::post('/', "$AppraisalSettingController@store")->name("$appraisalSettingRouteName.store");
            Route::get(
                '{appraisalSetting}',
                "$AppraisalSettingController@show"
            )->name("$appraisalSettingRouteName.show");
            Route::get(
                '{appraisalSetting}/edit',
                "$AppraisalSettingController@edit"
            )->name("$appraisalSettingRouteName.edit");
            Route::put(
                '{appraisalSetting}',
                "$AppraisalSettingController@update"
            )->name("$appraisalSettingRouteName.update");

            Route::get('getSettingById/{setting_id}', "$AppraisalSettingController@getSettingById")
                ->name("$appraisalSettingRouteName.settingsById");
            Route::get('getSignerById/{signer_id}', "$AppraisalSettingController@getSignerById")
                ->name("$appraisalSettingRouteName.getSignerById");
            Route::get('getCommenterById/{commenter_id}', "$AppraisalSettingController@getCommenterById")
                ->name("$appraisalSettingRouteName.getCommenterById");
        });
    });
    #--------------- // Appraisal Urls ---------------------------------

    #---------------- promotion Urls-----------------------------#
    Route::prefix('promotion')->group(function () {
        Route::get('/', 'PromotionController@index');
        Route::get('/promote', 'PromotionController@promote');
    });
    #--------------- // Promotion Urls ---------------------------------

    #---------------- Retirement Urls-----------------------------#
    Route::prefix('retirement')->group(function () {
        Route::get('/', 'AppraisalController@retirement');
        Route::get('/create', 'AppraisalController@create');
        Route::get('/{id}', 'AppraisalController@show');
        Route::delete('/{id}', 'AppraisalController@destroy');
        Route::get('edit/{id}', 'AppraisalController@edit');
    });
    #--------------- // Retirement Urls ---------------------------------

    Route::resources(
        [
            'employee' => 'EmployeeController',
            'department' => 'DepartmentController',
            'designation' => 'DesignationController',
            'sections' => 'SectionController',
            'house-details' => 'HouseDetailController',
            'house-categories' => 'HouseCategoryController',
            'house-circulars' => 'HouseCircularController',
            'contacts' => 'ContactController',
            'contact-types' => 'ContactTypeController'
        ]
    );

    // Get Houses By House Type
    Route::get('/get-house-by-type', 'HouseDetailController@getHouseByType')->name('get-house-by-type');

    /** House Application URL */
    Route::prefix('house-applications')->group(function () {
        Route::get('/{circularId}', 'HouseApplicationController@index')->name('house-applications.index');
        Route::get('/create/{circularId}', 'HouseApplicationController@create')->name('house-applications.create');
        Route::post('/store', 'HouseApplicationController@store')->name('house-applications.store');
        Route::get('/show/{applicantId}', 'HouseApplicationController@show')->name('house-applications.show');
        Route::get('/{houseApplication}/print', 'HouseApplicationController@print')->name('house-applications.print');
        Route::post(
            '/selection',
            'HouseApplicationController@applicantSelection'
        )->name('house-applications.selection');
        Route::post(
            '{houseCircular}/allocate-house-details/{houseApplication}',
            'HouseApplicationController@allocateHouseDetails'
        )
            ->name('house-applications.allocate-house-details');
    });

    Route::get('/house-histories/{id}', 'HouseDetailController@history')->name('house-histories');

    // Section
    Route::get('get-sections-by-dept-id/{deptId}', 'SectionController@getAllByDeptId')->name('get-sections');

    // Circular
    Route::prefix('circular')->group(function () {
        Route::get('/', 'CircularController@index')->name('circular.index');
        Route::get('create', 'CircularController@create')->name('circular.create');
        Route::post('create', 'CircularController@store')->name('circular.store');
        Route::get('{circular}/show', 'CircularController@show')->name('circular.show');
        Route::get('{circular}/edit', 'CircularController@edit')->name('circular.edit');
        Route::put('{circular}/edit', 'CircularController@update')->name('circular.update');
        Route::delete('{circular}/delete', 'CircularController@destroy')->name('circular.destroy');
    });

    // Job Circular
    Route::prefix('job-circular')->group(function () {
        Route::get('/', 'JobCircularController@index')->name('job-circular.index');
        Route::get('create', 'JobCircularController@create')->name('job-circular.create');
        Route::post('create', 'JobCircularController@store')->name('job-circular.store');
        Route::get('{jobCircular}/show', 'JobCircularController@show')->name('job-circular.show');
        Route::get('{jobCircular}/edit', 'JobCircularController@edit')->name('job-circular.edit');
        Route::put('{jobCircular}/edit', 'JobCircularController@update')->name('job-circular.update');
        Route::get('{jobCircular}/delete', 'JobCircularController@destroy')->name('job-circular.destroy');
        Route::prefix('{jobCircular}/minimum-qualifications')->group(function () {
            Route::get(
                '/create',
                'MinimumQualificationController@create'
            )->name('job-circular.minimum-qualification.create');
            Route::post('/', 'MinimumQualificationController@store')->name('job-circular.minimum-qualification.store');
        });
        Route::prefix('job-applications')->group(function () {
            Route::get('/', 'JobApplicationController@index')->name('job-application.index');
            Route::get('{jobApplication}/show', 'JobApplicationController@show')->name('job-application.show')
                ->where(['jobApplication' => '[0-9]+']);
            Route::put('{jobApplication}/update', 'JobApplicationController@update')->name('job-applications.update')
                ->where(['jobApplication' => '[0-9]+']);
        });

        Route::get(
            '/send-email/{id}',
            'JobCircularController@sendEmailToShortlisted'
        )->name('job-circular.email-shortlisted');
    });

    // Recruitment Exam
    Route::prefix('recruitment-exams')->group(function () {
        Route::get('/', 'RecruitmentExamController@index')->name('recruitment-exams.index');
        Route::get('/create/{circularId?}', 'RecruitmentExamController@create')->name('recruitment-exams.create');
        Route::post('store', 'RecruitmentExamController@store')->name('recruitment-exams.store');
        Route::get('/{id}', 'RecruitmentExamController@show')->name('recruitment-exams.show');
        Route::get('{id}/edit', 'RecruitmentExamController@edit')->name('recruitment-exams.edit');
        Route::put('{id}/edit', 'RecruitmentExamController@update')->name('recruitment-exams.update');
    });

    // Recruitment Exam Marks And Selection
    Route::prefix('recruitment-exam-marks')->group(function () {
        Route::get(
            '/create/{circularId}',
            'RecruitmentExamMarkController@recruitMentExamMarks'
        )->name('recruitment-exam-marks.create');
        Route::post('/store', 'RecruitmentExamMarkController@store')->name('recruitment-exam-marks.store');
        Route::get(
            '/result/{circularId}',
            'RecruitmentExamMarkController@recruitmentExamResultShow'
        )->name('recruitment-exam-marks.result');
        Route::post(
            '/final-selection',
            'RecruitmentExamMarkController@finalSelectionForRecruitment'
        )->name('recruitment-exam-marks.final-selection');
    });

    // Job Exam Admit Card
    Route::prefix('job-admit-cards')->group(function () {
        Route::get('{jobCircularId}/create', 'JobAdmitCardController@create')->name('job-admit-cards.create');
        Route::post('store', 'JobAdmitCardController@store')->name('job-admit-cards.store');
        Route::get('{admitCard}/edit', 'JobAdmitCardController@edit')->name('job-admit-cards.edit');
        Route::put('{admitCard}/edit', 'JobAdmitCardController@update')->name('job-admit-cards.update');
    });


    // Routes for Photocopy Management
    Route::prefix('photocopy')->group(function () {
        Route::get('/list', 'PhotocopyManagementController@index')->name('photocopy-management.list');
        Route::get('/show/{requestId}', 'PhotocopyManagementController@show')->name('photocopy-management.show');
        Route::get('/create', 'PhotocopyManagementController@create')->name('employee-punishment.create');
        Route::post('/create', 'PhotocopyManagementController@store')->name('employee-punishment.store');
    });

    // Routes for CV Evaluation
    Route::prefix('cv')->group(function () {
        Route::get('/list', 'CVEvaluationController@index')->name('cv.list');
        Route::get('/show/{requestId}', 'CVEvaluationController@show')->name('cv.show');
        Route::get('/create', 'CVEvaluationController@create')->name('cv.create');
        Route::post('/create', 'CVEvaluationController@store')->name('cv.store');
        Route::post('/update/{cvId}', 'CVEvaluationController@update')->name('cv.update');
        Route::post('/short-listed', 'CVEvaluationController@cvShortListed')->name('cv.short-listed');
    });

    // Routes for Calendar
    Route::prefix('calendar')->group(function () {
        Route::get('/', function () {
            return view('hrm::calendar.show');
        })->name('calendar');

        // Routes for Events
        Route::prefix('event')->group(function () {
            Route::get('/', 'CalendarEventController@index')->name('calendar-event.index');
            Route::get('/show/{calendarEvent}', 'CalendarEventController@show')->name('calendar-event.show');
            Route::get('/create', 'CalendarEventController@create')->name('calendar-event.create');
            Route::post('/create', 'CalendarEventController@store')->name('calendar-event.store');
            Route::get('{calendarEvent}/edit', 'CalendarEventController@edit')->name('calendar-event.edit');
            Route::put('{calendarEvent}/edit', 'CalendarEventController@update')->name('calendar-event.update');
            Route::delete('{calendarEvent}/delete', 'CalendarEventController@destroy')->name('calendar-event.delete');
        });
    });

    Route::prefix('complaint')->group(function () {
        Route::get('/list', 'ComplaintController@index')->name('complaint.index');
        Route::get(
            '/create/{complaintInvitation?}',
            'ComplaintController@create'
        )->name('complaint.create')->middleware(['complaintInvitationWorkflowComplainer']);
        Route::post('/', 'ComplaintController@store')->name('complaint.store');
        Route::get(
            '{complaint}/show',
            'ComplaintController@show'
        )->name('complaint.show')->middleware(['complaintWorkflowRecipient']);

        Route::middleware(['complaintWorkflowRecipient'])->prefix('{complaint}/workflow')
            ->group(function () {
                Route::get('/edit', 'ComplaintWorkflowController@edit')
                    ->name('complaint.workflow.edit');
                Route::put('/', 'ComplaintWorkflowController@update')
                    ->name('complaint.workflow.update');
            });

        Route::prefix('invitations')->group(function () {
            Route::get('/list', 'ComplaintInvitationController@index')->name('complaints.invitations.index');
            Route::get('create', 'ComplaintInvitationController@create')->name('complaints.invitations.create');
            Route::post('/', 'ComplaintInvitationController@store')->name('complaints.invitations.store');
            Route::get('{complaintInvitation}/show', 'ComplaintInvitationController@show')
                ->name('complaints.invitations.show');

            Route::middleware(['complaintInvitationWorkflowRecipient'])->prefix('{complaintInvitation}/workflow')
                ->group(function () {
                    Route::get('edit', 'ComplaintInvitationWorkflowController@edit')
                        ->name('complaints.invitations.workflow.edit');
                    Route::put('/', 'ComplaintInvitationWorkflowController@update')
                        ->name('complaints.invitations.workflow.update');
                });
        });
    });

    // Route(s) for HRM Religion(s)
    Route::prefix('religions')->group(function () {
        Route::get('', 'EmployeeReligionController@index')->name('employees.religions.index');
        Route::get('create', 'EmployeeReligionController@create')->name('employees.religions.create');
        Route::post('create', 'EmployeeReligionController@store')->name('employees.religions.store');
        Route::get('{religion}/show', 'EmployeeReligionController@show')->name('employees.religions.show');
        Route::get('{religion}/edit', 'EmployeeReligionController@edit')->name('employees.religions.edit');
        Route::put('{religion}', 'EmployeeReligionController@update')->name('employees.religions.update');
    });
});
