<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectDetailProposalAttachment extends Model
{
    protected $table = 'project_detail_proposal_attachments';

    protected $fillable = ['proposal_id','attachments','file_name'];
}
