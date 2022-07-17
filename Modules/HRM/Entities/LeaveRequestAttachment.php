<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveRequestAttachment extends Model
{
    protected $fillable = ['leave_request_id', 'attachment', 'file_name'];
}
