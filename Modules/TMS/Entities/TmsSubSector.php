<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsSubSector extends Model
{
    protected $fillable = ['code', 'tms_sector_id', 'title_bangla', 'title_english', 'sequence', 'details'];

    public function sector()
    {
        return $this->belongsTo(TmsSector::class, 'tms_sector_id', 'id');
    }

    public function getLocalizedTitle()
    {
        return app()->isLocale('bn') ? $this->title_bangla : $this->title_english;
    }

    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->title_bangla ?? trans('labels.not_found');
        } else {
            return $this->title_english ?? trans('labels.not_found');
        }
    }
}
