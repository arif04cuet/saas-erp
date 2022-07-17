<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class ComplaintAttachment extends Model
{
    protected $fillable = ['file_name', 'file_path'];

    public function attachmentable()
    {
        return $this->morphTo();
    }
}
