<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchDetailInvitationAttachment extends Model
{
    protected $table = "research_detail_invitation_attachments";
    protected $fillable = ["attachments", "research_detail_invitation_id", "file_name"];
}
