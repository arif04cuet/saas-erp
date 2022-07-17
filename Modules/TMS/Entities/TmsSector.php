<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsSector extends Model
{
    protected $fillable = ['code', 'title_bangla', 'title_english', 'sequence', 'details'];

    public function subSectors()
    {
        return $this->hasMany(TmsSubSector::class)->orderBy('sequence');
    }

    public function getLocalizedTitle()
    {
        return app()->isLocale('bn') ? $this->title_bangla : $this->title_english;
    }
}
