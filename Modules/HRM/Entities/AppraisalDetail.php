<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalDetail extends Model
{
    protected  $table = 'appraisal_details';
    protected $fillable = ['appraisal_id', 'content_id', 'marks', 'remarks'];

    public function content()
    {
        return $this->belongsTo(AppraisalContent::class, 'content_id', 'id');
    }
}
