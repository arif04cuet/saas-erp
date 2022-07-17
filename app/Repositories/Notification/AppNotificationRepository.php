<?php

/**
 * Created by PhpStorm.
 * User: Araf
 * Date: 2/4/2022
 * Time: 12:39 PM
 */

namespace App\Repositories\Notification;


use App\Entities\Notification\Notification;
use App\Repositories\AbstractBaseRepository;

class AppNotificationRepository extends AbstractBaseRepository
{
    protected $modelName = Notification::class;

    public function getAll($toUserId, $perPage)
    {
        return $this->model->with('type')->where('to_user_id', $toUserId)->orderBy('id', 'desc')->paginate($perPage);
    }

    public function markAsRead($toUserId)
    {
        $this->model->where('to_user_id', $toUserId)->update(['is_read' => true]);
    }

    public function getLatest($toUserId, $limit = 20)
    {
        return $this->model->with('type')->where('to_user_id', $toUserId)->latest()->limit($limit)->get();
    }

    public function deleteByUser($userId)
    {
        $this->model->where('to_user_id', $userId)->delete();
    }
}
