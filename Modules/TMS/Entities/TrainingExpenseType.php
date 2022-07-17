<?php

namespace Modules\TMS\Entities;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;

class TrainingExpenseType extends Model
{
    use DoptorAbleTrait;

    protected $fillable = ['title', 'title_bn', 'doptor_id'];

    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->title_bn ?? trans('labels.not_found');
        } else {
            return $this->title ?? trans('labels.not_found');
        }
    }
}
