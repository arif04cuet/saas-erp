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

Route::prefix('rms')->middleware(['auth', 'can:guest_access'])->group(function () {
    Route::get('/', 'RMSController@index')->name('rms.index');

    Route::prefix('researches')->group(function () {
        Route::get('/', 'ResearchController@index')->name('research.index');
        Route::get('/create', 'ResearchController@create')->name('research.create');
        Route::post('/', 'ResearchController@store')->name('research.store');
        Route::get('create-publication/{researchId}', 'ResearchController@createPublication')->name('research-publication.create');
        Route::post('store-publication/{researchId}', 'ResearchController@storePublication')->name('research-publication.store');
        Route::get('{research}', 'ResearchController@show')->name('research.show');
        Route::post('/send_research_for_publish/{id}', 'ResearchController@sendResearchForPublish')->name('research.send_research_for_publish');

        //            research workflow
        Route::get('review/{researchId?}/{featureId?}/{workflowMasterId?}/{workflowConversationId?}/{ruleDetailsId}', 'ResearchController@review')->name('research-publication.review');
        Route::post('/reviewUpdate', 'ResearchController@reviewUpdate')->name('research.reviewUpdate');
        Route::get('send-for-review/{researchProposalSubmissionId?}/{workflowMasterId?}/{shareConversationId?}', 'ResearchController@shareReview')->name('research.review');
        Route::post('send-for-review/{shareConversationId?}', 'ResearchController@shareFeedback')->name('research.share-feedback');
        Route::get('/re-initiate/{researchId?}/', 'ResearchController@reInitiate');
        Route::post('/research-re-initiated/{researchId?}/', 'ResearchController@storeReInitiate')->name('research-re-initiated');
        Route::get('research-workflow-close-reviewer/{workflowMasterId?}/{researchId?}', 'ResearchController@closeWorkflowByReviewer')->name('research-workflow-close-reviewer');


        Route::prefix('{research}')->group(function () {

            // research budgeting
            Route::prefix('budget')->group(function () {
                Route::get('/', 'ResearchBudgetController@index')->name('research-budget.index');
                Route::get('create', 'ResearchBudgetController@create')->name('research-budget.create');
                Route::post('store', 'ResearchBudgetController@store')->name('research-budget.store');
                Route::get('edit', 'ResearchBudgetController@edit')->name('research-budget.edit');
                Route::put('update', 'ResearchBudgetController@update')->name('research-budget.update');
            });
            // research organizations
            Route::prefix('organizations')->group(function () {
                Route::get('create', 'OrganizationController@create')->name('rms-organizations.create');
                Route::get('{organization}', 'OrganizationController@show')->name('rms-organizations.show');
            });
            // research tasks
            Route::prefix('tasks')->group(function () {
                Route::get('create', 'TaskController@create')->name('rms-tasks.create');
                Route::post('/', 'TaskController@store')->name('rms-tasks.store');
                Route::get('{task}', 'TaskController@show')->name('rms-tasks.show');
                Route::get('{task}/edit', 'TaskController@edit')->name('rms-tasks.edit');
                Route::put('{task}', 'TaskController@update')->name('rms-tasks.update');
                Route::delete('{task}', 'TaskController@destroy')->name('rms-tasks.destroy');
                // Task time
                Route::put('{task}/time', 'TaskTimeController@update')->name('rms-tasks.time');
            });
            // research monthly updates
            Route::prefix('monthly-updates')->group(function () {
                Route::get('create', 'ResearchMonthlyUpdateController@create')->name('rms-monthly-updates.create');
                Route::post('/', 'ResearchMonthlyUpdateController@store')->name('rms-monthly-updates.store');
                Route::get('{monthlyUpdate}', 'ResearchMonthlyUpdateController@show')->name('rms-monthly-updates.show');
                Route::get('{monthlyUpdate}/edit', 'ResearchMonthlyUpdateController@edit')->name('rms-monthly-updates.edit');
                Route::put('{monthlyUpdate}', 'ResearchMonthlyUpdateController@update')->name('rms-monthly-updates.update');
            });
        });
    });
    // organization
    Route::prefix('organizations/{organization}')->group(function () {
        // organization members
        Route::prefix('members')->group(function () {
            $OrganizationMemberController = '\App\Http\Controllers\OrganizationMemberController';
            Route::get('create', $OrganizationMemberController . '@create')->name('rms-organization-members.create');
            Route::post('/', $OrganizationMemberController . '@store')->name('rms-organization-members.store');
            Route::get('{member}/edit', $OrganizationMemberController . '@edit')->name('rms-organization-members.edit');
            Route::put('{member}', $OrganizationMemberController . '@update')->name('rms-organization-members.update');
        });
        // organization attribute
        Route::prefix('attributes')->group(function () {
            $AttributeController = '\App\Http\Controllers\AttributeController';
            Route::get('create', $AttributeController . '@create')->name('rms-attributes.create');
            Route::get('{attribute}/edit', $AttributeController . '@edit')->name('rms-attributes.edit');
            Route::get('{attribute}', $AttributeController . '@show')->name('rms-attributes.show');
        });
    });
    // attributes attribute values
    Route::prefix('attributes/{attribute}/values')->group(function () {
        $AttributeValueController = '\App\Http\Controllers\AttributeValueController';
        Route::get('create', $AttributeValueController . '@create')->name('rms-attribute-values.create');
        Route::get('{attributeValue}/edit', $AttributeValueController . '@edit')->name('rms-attribute-values.edit');
    });

    Route::prefix('research-requests')->group(function () {
        Route::get('/create', 'ResearchRequestController@create')->name('research-request.create');
        Route::get('/', 'ResearchRequestController@index')->name('research-request.index');
        Route::post('/', 'ResearchRequestController@store')->name('research-request.store');
        Route::get('attachment-download/{researchRequest}', 'ResearchRequestController@requestAttachmentDownload')->name('research-request.attachment-download');
        Route::get('file-download/{researchRequestAttachment}', 'ResearchRequestController@fileDownload')->name('research-request.file-download');
        Route::get('{researchRequest}/show', 'ResearchRequestController@show')->name('research-request.show');
        Route::get('{researchRequest}/edit', 'ResearchRequestController@edit')->name('research-request.edit');
        Route::put('{researchRequest}', 'ResearchRequestController@update')->name('research-request.update');
    });

    Route::prefix('research-proposal-submission')->group(function () {
        Route::get('/', 'ProposalSubmitController@index')->name('research-proposal-submission.index');
        Route::get('{researchRequest}/create', 'ProposalSubmitController@create')->name('research-proposal-submission.create');
        Route::post('/', 'ProposalSubmitController@store')->name('research-proposal-submission.store');
        Route::get('show/{id}', 'ProposalSubmitController@show')->name('research-proposal-submission.show');
        Route::get('{researchProposal}/edit', 'ProposalSubmitController@edit')->name('research-proposal-submission.edit');
        Route::put('{researchProposalSubmission}', 'ProposalSubmitController@update')->name('research-proposal-submission.update');
        Route::get('attachment-download/{researchProposalSubmission}', 'ProposalSubmitController@submissionAttachmentDownload')->name('research-proposal-submission.attachment-download');
        Route::get('file-download/{researchSubmissionAttachment}', 'ProposalSubmitController@fileDownload')->name('research-proposal-submission.file-download');

        //Routes for workflow research brief
        Route::get('review/{researchProposalSubmissionId?}/{featureName?}/{workflowMasterId?}/{workflowConversationId?}/{workflowRuleDetailsId?}/{viewOnly?}', 'ProposalSubmitController@review')->name('research-proposal-submission-review');
        Route::get('research-proposal-view-only/{researchProposalSubmissionId?}/{featureName?}/{workflowMasterId?}', 'ProposalSubmitController@viewOnly')->name('research-proposal-view-only');

        Route::post('/reviewUpdate', 'ProposalSubmitController@reviewUpdate')->name('research-proposal-submission.reviewUpdate');
        Route::get('re-initiate/{researchProposalSubmissionId?}/', 'ProposalSubmitController@reInitiate');
        Route::post('store-re-initiate/{researchProposalId?}/', 'ProposalSubmitController@storeInitiate')->name('store-re-initiate');
        Route::get('workflow-close/{workflowMasterId?}/{researchProposalId?}', 'ProposalSubmitController@closeWorkflowByOwner')->name('workflow-close');
        Route::get('workflow-close-reviewer/{workflowMasterId?}/{researchProposalId?}/{shareConversationId?}', 'ProposalSubmitController@closeWorkflowByReviewer')->name('workflow-close-reviewer');
//        Route::get('apc-review/{researchProposalSubmissionId?}', 'ProposalSubmitController@apcReview')->name('apc-review');
//        Route::post('apc-review/{researchProposalSubmissionId?}', 'ProposalSubmitController@approveApcReview')->name('approve-apc-review');
        Route::get('sending-for-review/{researchProposalSubmissionId?}/{workflowMasterId?}/{shareConversationId?}', 'ProposalSubmitController@getResearchFeedbackForm')->name('research-proposal-submission.review');
        Route::post('sending-for-review/{shareConversationId?}', 'ProposalSubmitController@postResearchFeedback')->name('research-proposal-submission.feedback');

        Route::post('reviewer-add-attachment', 'ProposalSubmitController@addAttachment')->name('research.proposal.reviewer.add.attachment');

    });

    Route::prefix('received-research-proposals')->group(function () {
        Route::get('/', 'ReceivedResearchProposalController@index')->name('received-research-proposal.index');
    });

    Route::prefix('invited-research-proposals')->group(function () {
        Route::get('/', 'InvitedResearchProposalController@index')->name('invited-research-proposal.index');
        Route::get('{researchRequest}', 'InvitedResearchProposalController@show')->name('invited-research-proposal.show');
        Route::get('file-download/{researchRequestAttachment}', 'InvitedResearchProposalController@fileDownload')->name('invited-research-proposal.file-download');
        Route::get('{researchRequest}/request-date-extend', 'InvitedResearchProposalController@requestDateExtend')->name('invited-research-proposal.request-date-extend');
        Route::post('/', 'InvitedResearchProposalController@storeDateExtendRequest')->name('invited-research-proposal.store-date-extend-request');
    });

    Route::prefix('research-proposal-details')->group(function () {
        Route::prefix('invitations')->group(function () {
            Route::get('/', 'ResearchDetailInvitationController@index')->name('invitations');
            Route::get('create/{researchProposalSubmission}', 'ResearchDetailInvitationController@create')->name('research-proposal-details.invitation.create');
            Route::post('store', 'ResearchDetailInvitationController@store')->name('research-proposal-details.invitation.store');
            Route::get('show/{researchDetailInvitation}', 'ResearchDetailInvitationController@show')->name('research-proposal-details.invitation.show');
            Route::get('edit/{researchDetailInvitation}', 'ResearchDetailInvitationController@edit')->name('research-proposal-details.invitation.edit');
            Route::put('update/{researchDetailInvitation}', 'ResearchDetailInvitationController@update')->name('research-proposal-details.invitation.update');
            Route::get('attachment-download/{researchDetailInvitation}', 'ResearchDetailInvitationController@attachmentDownload')->name('research-proposal-details.invitation.attachment-download');
            Route::get('file-download/{attachmentId}', 'ResearchDetailInvitationController@fileDownload')->name('research-proposal-details.invitation.file-download');
        });

        Route::get('/', 'ResearchProposalDetailController@index')->name('research.list');
        Route::get('/create/{briefId?}', 'ResearchProposalDetailController@create')->name('details.create');
        Route::post('/store', 'ResearchProposalDetailController@store')->name('research-details.store');
        Route::get('attachment-download/{researchDetailSubmission}', 'ResearchProposalDetailController@attachmentDownload');
//        Route::get('attachment-download/{researchDetailInvitation}', 'ResearchDetailInvitationController@attachmentDownload')->name('research-proposal-details.invitation.attachment-download');

        Route::get('file-download/{attachmentId}', 'ResearchProposalDetailController@fileDownload');

        //       workflow for research proposal details
        Route::get('review/{researchDetailId?}/{featureId?}/{workflowMasterId?}/{workflowConversationId?}/{workflowRuleDetailsId?}/{viewOnly?}', 'ResearchProposalDetailController@review')->name('research-proposal-detail-review');
        Route::post('/reviewUpdate', 'ResearchProposalDetailController@reviewUpdate')->name('research-detail-submission.reviewUpdate');
        Route::get('sending-for-review/{researchProposalSubmissionId?}/{workflowMasterId?}/{shareConversationId?}', 'ResearchProposalDetailController@getResearchDetailFeedbackForm')->name('research-detail.review');
        Route::post('sending-for-review/{shareConversationId?}', 'ResearchProposalDetailController@postResearchDetailFeedback')->name('research-detail.feedback');
        Route::get('re-initiate/{researchDetailSubmissionId?}/', 'ResearchProposalDetailController@reInitiate');
        Route::post('store-re-initiate/{researchDetailId?}/', 'ResearchProposalDetailController@storeInitiate')->name('store-detail-re-initiate');
        Route::get('workflow-close/{workflowMasterId?}/{researchDetailId?}', 'ResearchProposalDetailController@closeWorkflowByInitiator')->name('detail-workflow-close');
        Route::get('workflow-close-reviewer/{workflowMasterId?}/{researchDetailId?}/{shareConversationId?}', 'ResearchProposalDetailController@closeWorkflowByReviewer')->name('workflow-detail-close-reviewer');

        Route::post('reviewer-add-attachment', 'ResearchProposalDetailController@addAttachment')->name('research.detail.proposal.reviewer.add.attachment');

    });
});

