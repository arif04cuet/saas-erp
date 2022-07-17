<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $fillable = ['title', 'start', 'end', 'days', 'description'];
}
