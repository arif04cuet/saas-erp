<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchDetailSubmissionAttachment extends Model
{
    protected $table = 'research_detail_submission_attachments';
    protected $fillable = ['research_detail_submission_id', 'attachments', 'file_name'];
}
