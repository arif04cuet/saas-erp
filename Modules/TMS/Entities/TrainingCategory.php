<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;

class TrainingCategory extends Model
{
    use DoptorAbleTrait;

    // protected $table = 'training_category';
    protected $fillable = [
        'name_english',
        'name_bangla',
        'slug',
        'parent_id'
    ];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->name_bangla ?? trans('labels.not_found');
        }
        return $this->name_english ?? trans('labels.not_found');
    }
    public function getParentName()
    {
        if (app()->isLocale('bn')) {
            return $this->parent->name_bangla ?? trans('labels.not_found');
        }
        return $this->parent->name_english ?? trans('labels.not_found');
    }
    public function getParent()
    {
        if (app()->isLocale('bn')) {
            return $this->parent->name_bangla ?? '';
        }
        return $this->parent->name_english ?? '';
    }
    public function getSlug()
    {
        return $this->slug;
    }

    public function training()
    {
        return $this->hasOne(Training::class, 'category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(TrainingCategory::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(TrainingCategory::class, 'parent_id', 'id');
    }
}
