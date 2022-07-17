<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class CircularAttachment extends Model
{
    protected  $table = 'circular_attachments';
    protected $fillable = ['file_name', 'file_path', 'circular_id'];
}
