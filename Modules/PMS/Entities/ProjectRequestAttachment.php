<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectRequestAttachment extends Model
{
    protected $fillable = ['project_request_id', 'attachments','file_name'];
    protected $table = "project_request_attachments";
}
