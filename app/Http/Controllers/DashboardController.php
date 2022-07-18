<?php

namespace App\Http\Controllers;

use App\Services\Notification\AppNotificationService;
use Illuminate\Support\Facades\Auth;
use App\Models\Module as EntityModule;

class DashboardController extends Controller
{
    private $appNotificationService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AppNotificationService $appNotificationService)
    {
        $this->middleware('auth');
        $this->appNotificationService = $appNotificationService;
    }


    public function landing()
    {
        $notifications = $this->appNotificationService->getUnreadNotifications();
        if (Auth::user()->hasRole('ROLE_SUPER_ADMIN')) {
            $modules = EntityModule::all()->pluck('short_code', 'id');
        } else
            $modules = Auth::user()->doptor->modules->pluck('short_code', 'id');
        $doptorName = Auth::user()->doptor->getName();

        return view('dashboard', compact('modules', 'notifications', 'doptorName'));
    }
}
