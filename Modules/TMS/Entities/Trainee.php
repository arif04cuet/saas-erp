<?php

namespace Modules\TMS\Entities;

use App\Traits\DoptorAbleTrait;
use Modules\TMS\Entities\TraineeType;
use Illuminate\Database\Eloquent\Model;
use Modules\HM\Entities\CheckinTrainee;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainee extends Model
{
    // use DoptorAbleTrait;
    use SoftDeletes;

    protected $table = 'trainees';
    protected $fillable = [
        'training_id',
        'trainee_first_name',
        'trainee_last_name',
        'trainee_gender',
        'email',
        'mobile',
        'status',
        'deleted_at',
        'bangla_name',
        'english_name',
        'dob',
        'phone',
        'fax',
        'register_to_online',
        'photo',
        'badge_name',
        'badge_name_bn',
        'with_child',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class)->withDefault();
    }

    public function generalInfos()
    {
        return $this->hasOne(RegisteredTraineeGeneralInfo::class, 'trainee_id', 'id');
    }

    public function services()
    {
        return $this->hasOne(RegisteredTraineeServiceInfo::class, 'trainee_id', 'id');
    }

    public function emergencyContacts()
    {
        return $this->hasOne(RegisteredTraineeEmergency::class, 'trainee_id', 'id');
    }

    public function educations()
    {
        return $this->hasOne(RegisteredTraineeEducation::class, 'trainee_id', 'id');
    }
    public function traineeType()
    {
        return $this->hasOne(TraineeType::class, 'trainee_id', 'id');
    }

    public function physicalInfos()
    {
        return $this->hasOne(RegisteredTraineePhysicalInfo::class, 'trainee_id', 'id');
    }

    public function healthExaminations()
    {
        return $this->hasOne(RegisteredTraineeHealthExam::class, 'trainee_id', 'id');
    }

    public function getFullName()
    {
        return "$this->trainee_first_name $this->trainee_last_name";
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_name ?? trans('labels.not_found');
        } else {
            return $this->english_name ?? trans('labels.not_found');
        }
    }

    public function schedules()
    {
        return $this->hasMany(TrainingCourseScheduledSessionsTraineeEmailRecipient::class, 'trainee_id', 'id')
            ->whereIn('status', ['pending', 'failed']);
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'trainees', 'id', 'training_id');
    }

    public function checkinTrainee()
    {
        return $this->hasOne(CheckinTrainee::class, 'trainee_id', 'id');
    }
}
