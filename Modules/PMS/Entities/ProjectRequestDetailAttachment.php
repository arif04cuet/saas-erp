<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectRequestDetailAttachment extends Model
{
    protected $table = "project_request_detail_attachments";
    protected $fillable = ['attachments', 'file_name', 'project_request_detail_id'];
}
