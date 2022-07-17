<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchDetailInvitationReceiver extends Model
{
    protected $table = "research_detail_invitation_receivers";
    protected $fillable = ["to", "research_detail_invitation_id"];
}
