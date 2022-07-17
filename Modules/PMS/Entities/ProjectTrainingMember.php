<?php

namespace Modules\PMS\Entities;

use App\Entities\Organization\OrganizationMember;
use Illuminate\Database\Eloquent\Model;

class ProjectTrainingMember extends Model
{
    protected $fillable = ['member_id',  'training_id'];
    protected $table = 'project_training_members';

    public function trainings()
    {
        return $this->belongsTo(ProjectTraining::class, 'training_id', 'id' );
    }

    public function memberDetails()
    {
        return $this->belongsTo(OrganizationMember::class, 'member_id', 'id');
    }
}
