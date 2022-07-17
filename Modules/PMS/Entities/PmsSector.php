<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PmsSector extends Model
{
    protected $fillable = ['title_bangla', 'title_english', 'details'];

    public function subSectors()
    {
        return $this->hasMany(PmsSubSector::class);
    }
}
