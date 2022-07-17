<?php

namespace App\Http;

use App\Http\Middleware\CheckExpiryDate;
use App\Http\Middleware\ForcePasswordChange;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Modules\HRM\Http\Middleware\CheckAppraisalWorkflowRecipient;
use Modules\HRM\Http\Middleware\CheckComplaintInvitationWorkflowComplainer;
use Modules\HRM\Http\Middleware\CheckComplaintInvitationWorkflowRecipient;
use Modules\HRM\Http\Middleware\CheckComplaintWorkflowRecipient;
use Modules\HRM\Http\Middleware\CheckCompletedAppraisalRecipient;
use Modules\HRM\Http\Middleware\CheckEmployeeLeaveWorkflowRecipient;
use Modules\HRM\Http\Middleware\CheckLeaveRequestEditPermission;
use Modules\IMS\Http\Middleware\CheckAuctionWorkflowRecipient;
use Modules\IMS\Http\Middleware\CheckInventoryRequestWorkflowRecipient;
use Modules\PMS\Http\Middleware\CheckProjectAssignedRole;
use Modules\TMS\Http\Middleware\CanAccessTMS;
use Modules\TMS\Http\Middleware\CheckCourseAdministrator;
use Modules\TMS\Http\Middleware\CheckCourseEvaluationExpiry;
use Modules\TMS\Http\Middleware\CheckCourseIsEvaluated;
use Modules\TMS\Http\Middleware\CheckCourseSpeaker;
use Modules\TMS\Http\Middleware\CheckIsTrainingDivisionEmployee;
use Modules\TMS\Http\Middleware\CheckSessionEvaluationExpiry;
use Modules\TMS\Http\Middleware\CheckSessionIsEvaluated;
use Modules\TMS\Http\Middleware\CheckSessionSpeaker;
use Modules\TMS\Http\Middleware\CheckTrainingRegistrationDate;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LanguageMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'force_password' => ForcePasswordChange::class,
        'inventoryRequestRecipient' => CheckInventoryRequestWorkflowRecipient::class,
        'auctionRecipient' => CheckAuctionWorkflowRecipient::class,
        'leaveRequestRecipient' => CheckEmployeeLeaveWorkflowRecipient::class,
        'complaintInvitationWorkflowRecipient' => CheckComplaintInvitationWorkflowRecipient::class,
        'complaintWorkflowRecipient' => CheckComplaintWorkflowRecipient::class,
        'appraisalWorkflowRecipient' => CheckAppraisalWorkflowRecipient::class,
        'completedAppraisalRecipient' => CheckCompletedAppraisalRecipient::class,
        'leaveRequestEditPermission' => CheckLeaveRequestEditPermission::class,
        'complaintInvitationWorkflowComplainer' => CheckComplaintInvitationWorkflowComplainer::class,
        'expiryDate' => CheckExpiryDate::class,
        'sessionEvaluationExpiry' => CheckSessionEvaluationExpiry::class,
        'sessionIsEvaluated' => CheckSessionIsEvaluated::class,
        'isTrainingDivisionEmployee' => CheckIsTrainingDivisionEmployee::class,
        'canAccessTMS' => CanAccessTMS::class,
        'checkSessionSpeaker' => CheckSessionSpeaker::class,
        'checkCourseSpeaker' => CheckCourseSpeaker::class,
        'courseEvaluationExpiry' => CheckCourseEvaluationExpiry::class,
        'courseIsEvaluated' => CheckCourseIsEvaluated::class,
        'checkTrainingRegistrationDate' => CheckTrainingRegistrationDate::class,
        'checkCourseAdministrator' => CheckCourseAdministrator::class,
        'checkProjectAssignedRole' => CheckProjectAssignedRole::class,
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ];
}
