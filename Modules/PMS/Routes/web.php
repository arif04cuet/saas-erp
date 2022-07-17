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

Route::prefix('pms', 'can:guest_access')->middleware(['auth'])->group(function () {
    Route::get('/', 'PMSController@index')->name('pms');

    Route::prefix('projects')->group(function () {
        Route::get('/', 'ProjectController@index')->name('project.index');
        Route::get('/create', 'ProjectController@create')->name('project.create');
        Route::post('/', 'ProjectController@store')->name('project.store');
        Route::get('{project}', 'ProjectController@show')->name('project.show');
        Route::put('{project}', 'ProjectController@update')->name('project.update');
        Route::get('{project}/edit', 'ProjectController@edit')->name('project.edit');

        //Project Attribute Nov-7
        Route::get('{project}/attribute/create', 'ProjectAttributeController@create')->name('project-attributes.create');
        Route::post('{project}/attribute', 'ProjectAttributeController@store')->name('project-attributes.store');

        Route::get('{project}/attribute/planned/create', 'ProjectAttributePlannedValueController@create')->name('project-attributes-planned.create');
        Route::post('{project}attribute/planned', 'ProjectAttributePlannedValueController@store')->name('project-attributes-planned.store');

        Route::get('{project}/attribute/achieved/create', 'ProjectAttributeAchievedValueController@create')->name('project-attributes-achieved.create');
        Route::post('{project}/attribute/achieved/', 'ProjectAttributeAchievedValueController@store')->name('project-attributes-achieved.store');

        Route::get('{project}/projectattributes/{attribute}/graphs', 'ProjectAttributeController@graphValues');

        //Ajax Call for getting Planned&Achieved value by DateRange
        Route::post('getvaluebydaterange/{project}', 'ProjectAttributeController@filter')->name('filter.value.bydaterange');
        Route::post('getvaluebydaterangefororganization/{project}', 'ProjectController@filter')->name('filter.value.bydaterange.organization');

        Route::get('getmembers/{id}', 'ProjectController@getMembersByOrganizationId');



        Route::prefix('{project}')->group(function () {
            // training under a project
            Route::prefix('training')->group(function () {
                Route::get('/', 'ProjectTrainingController@index')->name('project-training.index');
                Route::get('create', 'ProjectTrainingController@create')->name('project-training.create');
                Route::post('store', 'ProjectTrainingController@store')->name('project-training.store');
                Route::get('{training}', 'ProjectTrainingController@show')->name('project-training.show');
                // training members
                Route::prefix('{training}/members')->group(function () {
                    Route::get('/', 'ProjectTrainingMemberController@index')->name('projectTraining-members.index');
                    Route::post(
                        'store',
                        'ProjectTrainingMemberController@store'
                    )->name('projectTraining-members.store');
                });
            });

            // project budgeting
            Route::prefix('budget')->group(function () {
                Route::get('/', 'ProjectBudgetsController@index')->name('project-budget.index');
                Route::get('create', 'ProjectBudgetsController@create')->name('project-budget.create');
                Route::post('store', 'ProjectBudgetsController@store')->name('project-budget.store');
                Route::get('edit', 'ProjectBudgetsController@edit')->name('project-budget.edit');
                Route::put('update', 'ProjectBudgetsController@update')->name('project-budget.update');

                //filter using budget
                Route::get('filter', 'ProjectBudgetsController@filterAsJson')->name('project-budget.filter');
            });



            // budget under a project
            Route::prefix('budget/{fiscalYear}')->group(function () {
                Route::get('{projectActivityBudget}', 'ProjectActivityBudgetController@index')->name('project-activity-budget.index');
                Route::get('create', 'ProjectActivityBudgetController@create')->name('project-activity-budget.create');
                Route::get('{projectActivityBudget}/edit', 'ProjectActivityBudgetController@create')->name('project-activity-budget.create');
                Route::post('/', 'ProjectActivityBudgetController@store')->name('project-activity-budget.store');
                Route::put('/', 'ProjectActivityBudgetController@store')->name('project-activity-budget.update');
            });
        });


        //project details related models
        Route::middleware('checkProjectAssignedRole')->prefix('{project}')->group(function () {
            //report
            Route::prefix('reports')->group(function () {
                Route::get(
                    'indicator',
                    'ProjectReportController@showIndicatorReport'
                )->name('project.report.indicator.show');
                Route::post(
                    'indicator',
                    'ProjectReportController@loadIndicatorReport'
                )->name('project.report.indicator.load');
            });

            // project organisations
            Route::prefix('organizations')->group(function () {
                Route::get('create', 'OrganizationController@create')->name('pms-organizations.create');
                Route::get('{organization}', 'OrganizationController@show')->name('pms-organizations.show');
                Route::get('{organization}/edit', 'OrganizationController@edit')->name('pms-organizations.edit');
                Route::put('{organization}', 'OrganizationController@update')->name('pms-organizations.update');
                // organisation members
                Route::prefix('{organization}/members')->group(function () {
                    Route::get(
                        'create',
                        'OrganizationMemberController@create'
                    )->name('pms-organization-members.create');
                    Route::get('{member}', 'OrganizationMemberController@show')->name('organization-members.show');
                    Route::get(
                        '{member}/edit',
                        'OrganizationMemberController@edit'
                    )->name('pms-organization-members.edit');
                    // member attribute
                    Route::prefix('{member}')->group(function () {
                        Route::get('attributes/values/create', function () {
                            return 'hello world';
                        });
                        Route::get(
                            'attributes/{attribute}',
                            'MemberAttributeController@show'
                        )->name('member-attributes.show');
                        Route::get(
                            'attributes/values/create',
                            'MemberAttributeValueController@create'
                        )->name('member-attribute-values.create');
                        Route::post(
                            'attributes/values',
                            'MemberAttributeValueController@store'
                        )->name('member-attribute-values.store');
                    });
                });
            });

            // research tasks
            Route::prefix('tasks')->group(function () {
                Route::get('create', 'TaskController@create')->name('pms-tasks.create');
                Route::post('/', 'TaskController@store')->name('pms-tasks.store');
                Route::get('{task}', 'TaskController@show')->name('pms-tasks.show');
                Route::get('{task}/edit', 'TaskController@edit')->name('pms-tasks.edit');
                Route::put('{task}', 'TaskController@update')->name('pms-tasks.update');
                Route::delete('{task}', 'TaskController@destroy')->name('pms-tasks.destroy');
                // Task time
                Route::put('{task}/time', 'TaskTimeController@update')->name('pms-tasks.time');
            });
            // research monthly updates
            Route::prefix('monthly-updates')->group(function () {
                Route::get('create', 'ProjectMonthlyUpdateController@create')->name('pms-monthly-updates.create');
                Route::post('/', 'ProjectMonthlyUpdateController@store')->name('pms-monthly-updates.store');
                Route::get('{monthlyUpdate}', 'ProjectMonthlyUpdateController@show')->name('pms-monthly-updates.show');
                Route::get(
                    '{monthlyUpdate}/edit',
                    'ProjectMonthlyUpdateController@edit'
                )->name('pms-monthly-updates.edit');
                Route::put(
                    '{monthlyUpdate}',
                    'ProjectMonthlyUpdateController@update'
                )->name('pms-monthly-updates.update');
            });
            // attribute & plannings
            Route::prefix('attributes')->group(function () {
                Route::get('create', 'AttributeController@create')->name('attributes.create');
                Route::post('/', 'AttributeController@store')->name('attributes.store');
                Route::get(
                    '{attribute}/plannings',
                    'AttributePlanningController@index'
                )->name('attribute-plannings.index');
                Route::get('{attribute}', 'AttributeController@show')->name('attributes.show');
                Route::get('{attribute}/edit', 'AttributeController@edit')->name('attributes.edit');
                Route::put('{attribute}', 'AttributeController@update')->name('attributes.update');
                Route::delete('{attribute}', 'AttributeController@destroy')->name('attributes.destroy');
                // graph
                Route::get('{attribute}/graphs', 'AttributeController@graphValues');
            });
            Route::get(
                'attributes-plannings/create',
                'AttributePlanningController@create'
            )->name('attribute-plannings.create');
            Route::post('attributes-plannings', 'AttributePlanningController@store')->name('attribute-plannings.store');


            // Project Activity
            Route::prefix('activity')->group(function () {
                Route::get('create', 'ProjectActivityController@create')->name('pms-activity.create');
                Route::post('/', 'ProjectActivityController@store')->name('pms-activity.store');
                Route::get('{activity}', 'ProjectActivityController@show')->name('pms-activity.show');
                Route::get('{activity}/edit', 'ProjectActivityController@edit')->name('pms-activity.edit');
                Route::put('{activity}', 'ProjectActivityController@update')->name('pms-activity.update');

                // Project Activity Tasks
                Route::prefix('{activity}/tasks')->group(function () {
                    Route::get('create', 'ProjectActivityController@taskCreate')->name('pms-activity-tasks.create');
                    Route::post('/', 'ProjectActivityController@taskStore')->name('pms-activity-tasks.store');
                    Route::get('{task}', 'ProjectActivityController@taskShow')->name('pms-activity-tasks.show');
                    Route::get('{task}/edit', 'ProjectActivityController@taskEdit')->name('pms-activity-tasks.edit');
                    Route::put('{task}', 'ProjectActivityController@taskUpdate')->name('pms-activity-tasks.update');
                    Route::delete(
                        '{task}',
                        'ProjectActivityController@taskDestroy'
                    )->name('pms-activity-tasks.destroy');
                    // Task time
                    Route::put('{task}/time', 'ProjectActivityController@timeUpdate')->name('pms-activity-tasks.time');
                });

                // Activity Task Monthly Updates
                Route::prefix('{activity}/monthly-updates')->group(function () {
                    Route::get(
                        'create',
                        'ActivityTaskMonthlyUpdateController@create'
                    )->name('pms-activity-task-monthly-updates.create');
                    Route::post(
                        '/',
                        'ActivityTaskMonthlyUpdateController@store'
                    )->name('pms-activity-task-monthly-updates.store');
                    Route::get(
                        '{monthlyUpdate}',
                        'ActivityTaskMonthlyUpdateController@show'
                    )->name('pms-activity-task-monthly-updates.show');
                    Route::get(
                        '{monthlyUpdate}/edit',
                        'ActivityTaskMonthlyUpdateController@edit'
                    )->name('pms-activity-task-monthly-updates.edit');
                    Route::put(
                        '{monthlyUpdate}',
                        'ActivityTaskMonthlyUpdateController@update'
                    )->name('pms-activity-task-monthly-updates.update');
                });
            });
        });
    });
    // Organization
    Route::prefix('organizations/{organization}')->group(function () {
        // organization members
        Route::prefix('members')->group(function () {
            $OrganizationMemberController = '\Modules\PMS\Http\Controllers\OrganizationMemberController';
            //            Route::get('create', $OrganizationMemberController . '@create')->name('pms-organization-members.create');
            Route::post('/', $OrganizationMemberController . '@store')->name('pms-organization-members.store');
            Route::put('{member}', $OrganizationMemberController . '@update')->name('pms-organization-members.update');
        });
        // organization attribute
        Route::prefix('attributes')->group(function () {
            $AttributeController = '\App\Http\Controllers\AttributeController';
            Route::get('create', $AttributeController . '@create')->name('pms-attributes.create');
            Route::get('{attribute}/edit', $AttributeController . '@edit')->name('pms-attributes.edit');
        });
    });
    // attributes attribute values
    Route::prefix('attributes/{attribute}/values')->group(function () {
        $AttributeValueController = '\App\Http\Controllers\AttributeValueController';
        Route::get('create', $AttributeValueController . '@create')->name('pms-attribute-values.create');
        Route::get('{attributeValue}/edit', $AttributeValueController . '@edit')->name('pms-attribute-values.edit');
    });

    Route::prefix('project-requests')->group(function () {
        Route::get('/', 'ProjectRequestController@index')->name('project-request.index');
        Route::get('/create', 'ProjectRequestController@create')->name('project-request.create');
        Route::post('/', 'ProjectRequestController@store')->name('project-request.store');
        Route::get('{projectRequest}/show', 'ProjectRequestController@show')->name('project-request.show');
        Route::get('{projectRequest}/edit', 'ProjectRequestController@edit')->name('project-request.edit');
        Route::put('{projectRequest}', 'ProjectRequestController@update')->name('project-request.update');
        Route::get(
            'attachment-download/{projectRequest}',
            'ProjectRequestController@requestAttachmentDownload'
        )->name('project-request.attachment-download');
        Route::get(
            'file-download/{projectRequestAttachment}',
            'ProjectRequestController@fileDownload'
        )->name('project-request.file-download');
    });

    Route::prefix('project-requests-details')->group(function () {
        Route::get('/', 'ProjectRequestDetailsController@index')->name('project-request-details.index');
        Route::get(
            'create/{projectProposal}',
            'ProjectRequestDetailsController@create'
        )->name('project-request-details.create');
        Route::post('/', 'ProjectRequestDetailsController@store')->name('project-request-details.store');
        Route::get(
            '{projectRequestDetail}/show',
            'ProjectRequestDetailsController@show'
        )->name('project-request-details.show');
        Route::get(
            '{projectRequestDetail}/edit',
            'ProjectRequestDetailsController@edit'
        )->name('project-request-details.edit');
        Route::put(
            '{projectRequestDetail}',
            'ProjectRequestDetailsController@update'
        )->name('project-request-details.update');
        Route::get(
            'attachment-download/{projectRequestDetail}',
            'ProjectRequestDetailsController@attachmentDownload'
        )->name('project-request-details.attachment-download');
        Route::get(
            'file-download/{attachmentId}',
            'ProjectRequestDetailsController@fileDownload'
        )->name('project-request-details.file-download');
    });

    Route::prefix('project-proposal-submission')->group(function () {
        Route::get('/', 'ProjectProposalController@index')->name('project-proposal-submission.index');
        Route::get(
            '{projectRequest}/create',
            'ProjectProposalController@create'
        )->name('project-proposal-submission.create');
        Route::post('/', 'ProjectProposalController@store')->name('project-proposal-submission.store');
        Route::get(
            'attachment-download/{projectProposal}',
            'ProjectProposalController@proposalAttachmentDownload'
        )->name('project-proposal.attachment-download');
        Route::get(
            'file-download/{projectProposalFile}',
            'ProjectProposalController@fileDownload'
        )->name('project-proposal-submission.file-download');
    });

    Route::prefix('project-details-proposal-submission')->group(function () {
        Route::get('/', 'ProjectDetailsProposalController@index')->name('project-details-proposal-submission.index');
        Route::get(
            '{projectRequest}/create',
            'ProjectDetailsProposalController@create'
        )->name('project-details-proposal-submission.create');
        Route::post('/', 'ProjectDetailsProposalController@store')->name('project-details-proposal-submission.store');
        Route::get(
            'attachment-download/{projectProposal}',
            'ProjectProposalController@proposalAttachmentDownload'
        )->name('project-details-proposal.attachment-download');
        Route::get(
            'file-download/{projectProposalFile}',
            'ProjectProposalController@fileDownload'
        )->name('project-details-proposal-submission.file-download');

        Route::prefix('{projectDetailProposal}/budget')->group(function () {
            Route::get(
                'export/{tableType}',
                'ProjectDetailProposalBudgetController@exportExcel'
            )->name('project-detail-proposal-budget.export-excel');
            Route::get(
                '/',
                'ProjectDetailProposalBudgetController@index'
            )->name('project-detail-proposal-budget.index');
            Route::get(
                'create',
                'ProjectDetailProposalBudgetController@create'
            )->name('project-detail-proposal-budget.create');
            Route::post(
                'store',
                'ProjectDetailProposalBudgetController@store'
            )->name('project-detail-proposal-budget.store');
            Route::get(
                '{draftProposalBudget}/edit',
                'ProjectDetailProposalBudgetController@edit'
            )->name('project-detail-proposal-budget.edit');
            Route::put(
                '{draftProposalBudget}/update',
                'ProjectDetailProposalBudgetController@update'
            )->name('project-detail-proposal-budget.update');
            Route::get(
                '/get-budget-expense',
                'ProjectDetailProposalBudgetController@getBudgetExpense'
            )->name('project-detail-proposal-budget.get-budget-expense');
        });
    });

    Route::prefix('project-proposal-submitted')->group(function () {
        Route::get('/', 'ReceivedProjectProposalController@index')->name('project-proposal-submitted.index');
        Route::get('/{id?}', 'ReceivedProjectProposalController@show')->name('project-proposal-submitted.view');
        //Routes for workflow
        Route::get(
            '/review/{proposalId}/{wfMasterId}/{wfConvId}/{featureId}/{ruleDetailsId}/{viewOnly?}',
            'PMSController@review'
        )->name('project-proposal-submitted-review');
        Route::post(
            '/review/{proposalId}',
            'PMSController@reviewUpdate'
        )->name('project-proposal-submitted-review-update');
        Route::post('/review-bulk/', 'PMSController@reviewBulk')->name('project-proposal-submitted.review-bulk');
        Route::get(
            '/resubmit/{proposalId}/{featureId}',
            'PMSController@resubmit'
        )->name('project-proposal-submitted-resubmit');
        Route::post(
            '/resubmit/{proposalId}',
            'PMSController@storeResubmit'
        )->name('project-proposal-submitted-save-resubmit');
        Route::get('/close/{wfMasterId}', 'PMSController@close')->name('project-proposal-submitted-close');
        Route::get('/approve/{proposalId}', 'PMSController@approve')->name('project-proposal-submitted-approve');
        Route::post(
            '/approve/{proposalId}',
            'PMSController@storeApprove'
        )->name('project-proposal-submitted-store-approve');
        Route::post('/share', 'PMSController@share')->name('project-proposal.share');
        Route::get(
            'sending-project-for-review/{projectProposalSubmissionId?}/{shareConversationId?}',
            'PMSController@shareReview'
        )->name('sending-project-for-review');
        Route::post(
            'posting-review/{shareConversationId?}',
            'PMSController@shareFeedback'
        )->name('project-proposal-submission.feedback');
        Route::post(
            'reviewer-add-attachment',
            'PMSController@addAttachment'
        )->name('project.proposal.reviewer.add.attachment');
    });

    Route::prefix('project-details-proposal-submitted')->group(function () {
        Route::get('/', 'ReceivedProjectProposalController@index')->name('project-details-proposal-submitted.index');
        Route::get('/{id?}', 'ReceivedProjectProposalController@show')->name('project-details-proposal-submitted.view');
        //Routes for project detail proposal workflow
        Route::get(
            '/review/{proposalId}/{wfMasterId}/{wfConvId}/{featureId}/{ruleDetailsId}/{viewOnly?}',
            'ProjectDetailsProposalController@review'
        )->name('project-details-proposal-submitted-review');
        Route::post(
            '/review/{proposalId}',
            'ProjectDetailsProposalController@reviewUpdate'
        )->name('project-details-proposal-submitted-review-update');
        Route::post('/review-bulk/', 'PMSController@reviewBulk')->name('project-proposal-submitted.review-bulk');
        Route::get(
            '/resubmit/{proposalId}/{featureId}',
            'ProjectDetailsProposalController@resubmit'
        )->name('project-detail-proposal-submitted-resubmit');
        Route::post(
            '/resubmit/{proposalId}',
            'ProjectDetailsProposalController@storeResubmit'
        )->name('project-detail-proposal-submitted-save-resubmit');
        Route::get(
            '/close/{wfMasterId}',
            'ProjectDetailsProposalController@close'
        )->name('project-details-proposal-submitted-close');
        Route::get('/approve/{proposalId}', 'PMSController@approve')->name('project-proposal-submitted-approve');
        Route::post(
            '/approve/{proposalId}',
            'PMSController@storeApprove'
        )->name('project-proposal-submitted-store-approve');
        Route::get(
            'sending-project-for-review/{projectProposalSubmissionId?}/{shareConversationId?}',
            'ProjectDetailsProposalController@shareReview'
        )->name('sending-project-detail-for-review');
        Route::post(
            'posting-review/{shareConversationId?}',
            'ProjectDetailsProposalController@shareFeedback'
        )->name('project-detail-proposal-submission.feedback');
        Route::post(
            'reviewer-add-attachment',
            'ProjectDetailsProposalController@addAttachment'
        )->name('project.proposal.detail.reviewer.add.attachment');
    });
});
