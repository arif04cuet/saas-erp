<?php

namespace App\Http\Controllers;

use App\Services\Notification\AppNotificationService;
use Illuminate\Http\Request;
use App\Traits\CrudTrait;
use Modules\TMS\Entities\TrainingCourseResource;

class LandingPageController extends Controller
{
    use CrudTrait;
    private $appNotificationService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AppNotificationService $appNotificationService)
    {
        // $this->middleware('auth');
        $this->appNotificationService = $appNotificationService;
    }
    public function index()
    {
        $instructorCount = TrainingCourseResource::all();
    }
}
