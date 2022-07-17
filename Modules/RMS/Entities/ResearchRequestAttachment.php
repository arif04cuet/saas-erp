<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchRequestAttachment extends Model
{
    protected $table = 'research_request_attachments';
    protected $fillable = ['attachments', 'research_request_id', 'file_name'];
}
