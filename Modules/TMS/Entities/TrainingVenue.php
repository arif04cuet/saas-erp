<?php

namespace Modules\TMS\Entities;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingCourseBreak;
use App\Traits\DoptorAbleTrait;

class TrainingVenue extends Model
{
    use DoptorAbleTrait;
    
    protected $fillable = ['title', 'title_bn', 'doptor_id'];

    public function break()
    {
        return $this->belongsTo(TrainingCourseBreak::class, 'id', 'entity_id');
    }
    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->title_bn ?? trans('labels.not_found');
        } else {
            return $this->title ?? trans('labels.not_found');
        }
    }

}
