<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectProposalFile extends Model
{
    protected $table = 'project_proposal_files';

    protected $fillable = ['proposal_id','attachments','file_name'];
}
