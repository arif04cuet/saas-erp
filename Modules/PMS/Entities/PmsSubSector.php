<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PmsSubSector extends Model
{
    protected $fillable = ['pms_sector_id', 'title_bangla', 'title_english', 'details'];

    public function sector()
    {
        return $this->belongsTo(PmsSector::class, 'pms_sector_id', 'id');
    }
}
