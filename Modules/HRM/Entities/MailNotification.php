<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class MailNotification extends Model
{
    protected $fillable = ['email', 'title', 'message', 'item_url', 'status'];
}
