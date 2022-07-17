<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 3:02 PM
 */

namespace App\Http\Controllers;


use App\Services\Notification\AppNotificationService;

class AppNotificationController extends Controller
{
    private $appNotificationService;

    /**
     * AppNotificationController constructor.
     * @param $appNotificationService
     */
    public function __construct(AppNotificationService $appNotificationService)
    {
        $this->appNotificationService = $appNotificationService;
    }


    public function index()
    {
        $notifications = $this->appNotificationService->getAll(25);
        //
        $this->appNotificationService->markAsRead();

        return view('notification.index', compact('notifications'));
    }

    public function getLatestNotifications()
    {
        $notifications = $this->appNotificationService->getLatest();
        $response = new \stdClass();
        $response->data = $notifications;

        //
        $this->appNotificationService->markAsRead();

        return response()->json($response);
    }

    public function getUnreadNotification()
    {
        $notifications = $this->appNotificationService->getUnreadNotifications();
        $response = new \stdClass();
        $response->data = $notifications;

        //
        $this->appNotificationService->markAsRead();

        return response()->json($response);
    }

    public function countUnread()
    {
        $count = $this->appNotificationService->getUnreadNotifications()->count();
        $response = new \stdClass();
        $response->data = $count;

        return response()->json($response);
    }

    public function markAsRead()
    {
        $this->appNotificationService->markAsRead();
        $response = new \stdClass();
        $response->data = 'Success';

        return response()->json($response);
    }

    public function clearAll()
    {
        $this->appNotificationService->clearAll();
        return redirect()->route('notification.index');
    }
}
