<?php

namespace Modules\TMS\Entities;

use App\Traits\DoptorAbleTrait;
use Modules\TMS\Entities\TmsBudget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Training extends Model
{
    use DoptorAbleTrait;
    use SoftDeletes;

    protected $table = 'trainings';

    protected $fillable = [
        'uid',
        'training_head_id',
        'title',
        'bangla_title',
        'start_date',
        'end_date',
        'no_of_trainee',
        'status',
        'level',
        'category_id',
        'no_of_batches',
        'registration_deadline',
        'lang_preference',
        'doptor_id',
        'budget_id',
        'venue_id',
        'through_training',
        'accommodation',
        'enroll_type',
        'photo',
        'created_at',
        'updated_at'
    ];

    public static function getStatuses()
    {
        return config('tms.training.statuses');
    }

    public static function getLangPreferences()
    {
        return config('tms.trainee.language_preference');
    }
    public static function getThroughTraining()
    {
        return config('tms.training.through_training');
    }
    public static function getAccommodation()
    {
        return config('tms.training.accommodation_type');
    }
    public static function getEnrollAllowType()
    {
        return config('tms.training.enroll_type');
    }

    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_title ?? trans('labels.not_found');
        }
        return $this->title ?? trans('labels.not_found');
    }

    public function trainee()
    {
        return $this->hasMany(Trainee::class, 'training_id');
    }

    public function trainingParticipants()
    {
        return $this->hasMany(TrainingParticipant::class, 'training_id');
    }

    public function trainingSponsors()
    {
        return $this->hasMany(TrainingSponsor::class, 'training_id');
    }

    public function trainingOrganizations()
    {
        return $this->belongsToMany(TrainingOrganization::class, 'training_sponsors');
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'category_id', 'id');
    }

    public function participants()
    {
        return $this->belongsToMany(TrainingParticipantType::class, 'training_participants');
    }

    public function batches()
    {
        return $this->hasManyThrough(TrainingCourseBatch::class, TrainingCourse::class);
    }

    public function modules()
    {
        return $this->hasManyThrough(TrainingCourseModule::class, TrainingCourse::class);
    }

    public function sessions()
    {
        return $this->modules()->get()->map(function ($module) {
            return $module->sessions;
        })->flatten();
    }

    public function courses()
    {
        return $this->hasMany(TrainingCourse::class, 'training_id', 'id');
    }

    public function resources()
    {
        return $this->hasManyThrough(TrainingCourseResource::class, TrainingCourse::class);
    }

    /**
     * This is old relation when table didnt have a training id
     * Now you can use this->administrations
     * @return HasManyThrough
     */
    public function administrators()
    {
        return $this->hasManyThrough(TrainingCourseAdministration::class, TrainingCourse::class);
    }

    // public function tmsBudget()
    // {
    //     return $this->hasOne(TmsBudget::class, 'training_id', 'id');
    // }

    public function tmsBudget()
    {
        return $this->hasOne(TmsBudget::class, 'id', 'budget_id');
    }
    public function trainingCategory()
    {
        return $this->hasOne(TrainingCategory::class, 'id', 'category_id');
    }

    public function journalEntries()
    {
        return $this->hasMany(TmsJournalEntry::class);
    }

    public function administrations()
    {
        return $this->hasMany(TrainingCourseAdministration::class, 'training_id', 'id');
    }

    public function trainingHead()
    {
        return $this->belongsTo(TrainingHead::class, 'training_head_id', 'id')->withDefault();
    }

    public function trainingCostSegmentation()
    {
        return $this->hasMany(TrainingCostSegmentation::class, 'training_id', 'id');
    }
}
