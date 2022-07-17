<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AcademicDepartment extends Model
{
	protected $table = "academic_departments";
    protected $fillable = [
    	'name'
    ];
}
