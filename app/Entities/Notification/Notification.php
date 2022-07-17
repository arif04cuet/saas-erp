<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/30/19
 * Time: 7:21 PM
 */

namespace App\Entities\Notification;


use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['type_id', 'ref_table_id', 'from_user_id', 'to_user_id', 'message', 'is_read', 'item_url'];

    public function type()
    {
        return $this->belongsTo(NotificationType::class, 'type_id');
    }
}
