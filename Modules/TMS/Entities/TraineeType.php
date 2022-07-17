<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TraineeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_type',
        'trainee_id',
        'org_name',
        'org_id',
        'org_member_name',
        'org_member_join_date',
        'doptor_name',
        'doptor_service_id',
        'doptor_present_designation',
        'doptor_join_date',
        'doptor_present_designation_join_date'
    ];

    // public function traineeType()
    // {
    //     return $this->hasOne(Trainee::class, 'id', 'trainee_id');
    // }
    
}
