<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalInvitation extends Model
{
    protected $table = 'appraisal_invitations';
    protected $fillable = [
        'memorandum_no',
        'title',
        'appraisal_setting_id',
        'deadline_to_signer',
        'deadline_to_final_commenter',
        'deadline_final_commenter_sign'
    ];

    public function appraisalSetting()
    {
        return $this->belongsTo(AppraisalSetting::class, 'appraisal_setting_id', 'id');
    }
}
