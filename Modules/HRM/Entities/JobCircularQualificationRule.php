<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Jobs\Job;

class JobCircularQualificationRule extends Model
{
    protected $table = 'job_circular_qualification_rules';

    protected $fillable = ['job_circular_id' ,'min_ssc_year' ,'min_hsc_year', 'min_grad_year', 'min_post_grad_year', 'ssc_point', 'hsc_point', 'grad_point', 'post_grad_point', 'gender', 'upper_age_limit', 'lower_age_limit'];

    public function jobCircular()
    {
        return $this->hasOne(JobCircular::class);
    }

}
