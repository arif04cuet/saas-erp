<?php

namespace Modules\TMS\Entities;

use App\Traits\DoptorAbleTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingCourseGrade;
use Modules\TMS\Entities\TrainingCoursePayment;
use Modules\TMS\Entities\TrainingParticipantType;

class TrainingCourse extends Model
{
    use DoptorAbleTrait;
    
    protected $fillable = ['uid', 'training_id', 'venue_id', 'name', 'name_bn', 'photo', 'start_date', 'end_date','registration_deadline', 'course_detail_bn', 'course_detail_en','trainee_type'];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

    public function objectives()
    {
        return $this->hasMany(TrainingCourseObjective::class, 'training_course_id', 'id');
    }

    public function methods()
    {
        return $this->hasMany(TrainingCourseMethodStrategy::class, 'training_course_id', 'id');
    }

    public function guidelines()
    {
        return $this->hasMany(TrainingCourseRuleGuideline::class, 'training_course_id', 'id');
    }

    public function breaks()
    {
        return $this->hasMany(TrainingCourseBreak::class, 'training_course_id', 'id');
    }

    public function administrations()
    {
        return $this->hasMany(TrainingCourseAdministration::class, 'training_course_id', 'id');
    }

    public function batches()
    {
        return $this->hasMany(TrainingCourseBatch::class, 'training_course_id', 'id');
    }

    public function guests()
    {
        return $this->hasMany(TrainingCourseGuest::class);
    }

    public function resources()
    {
        return $this->hasMany(TrainingCourseResource::class, 'training_course_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(TrainingVenue::class, 'venue_id');
    }

    public function markAllotments()
    {
        return $this->hasMany(TrainingCourseMarkAllotment::class, 'training_course_id', 'id');
    }

    public function modules()
    {
        return $this->hasMany(TrainingCourseModule::class, 'training_course_id', 'id');
    }

    public function evaluationSetting()
    {
        return $this->hasOne(CourseEvaluationSetting::class, 'training_course_id', 'id');
    }
    public function trainingCoursePayment()
    {
        return $this->hasOne(TrainingCoursePayment::class, 'course_id', 'id');
    }

    public function evaluationSections()
    {
        return $this->hasMany(CourseEvaluationSection::class, 'training_course_id');
    }

    public function courseEvaluationSubmission()
    {
        return $this->hasMany(CourseEvaluationSubmission::class, 'training_course_id');
    }
    public function participantType()
    {
        return $this->belongsTo(TrainingParticipantType::class, 'trainee_type', 'id');
    }

    public function trainingCourseGrade()
    {
        return $this->hasMany(TrainingCourseGrade::class, 'training_course_id', 'id');
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return empty($this->name_bn) ? $this->name : $this->name_bn; // if bn name not found return english
        }
        return $this->name ?? trans('labels.not_found');
    }


}
