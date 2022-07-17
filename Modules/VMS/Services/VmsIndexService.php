<?php

namespace Modules\VMS\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use Modules\VMS\Entities\Trip;

class VmsIndexService
{


    public function getPendingNotificationsForUser()
    {
        $pendingNotifications = collect();
        $notificationType = $this->getTripNotificationType();
        // find out which trips are still pending
        $pendingTripsId = Trip::query()->whereStatus('pending')->pluck('id')->toArray();
        // get the latest notifications of these trips
        foreach ($pendingTripsId as $pendingTripId) {
            $notification = Notification::query()
                ->where('type_id', $notificationType->id)
                ->where('ref_table_id', $pendingTripId)
                ->max('id');
            $pendingNotifications->push($notification);
        }
        return Notification::whereIn('id', $pendingNotifications->toArray())->where('to_user_id',
            auth()->user()->id)->orderBy('created_at','desc')->get();
    }

    public function getTripNotificationType()
    {
        $notificationType = NotificationTypeConstant::VMS_TRIP_REQUEST;
        return NotificationType::where('name', $notificationType)->first();
    }


}

