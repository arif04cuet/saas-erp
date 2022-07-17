<?php

namespace App\Entities\monthlyUpdate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyUpdateAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'monthly_update_attachments';

    protected $fillable = ['monthly_updatable_id', 'file_name', 'file_ext', 'file_path'];
}
