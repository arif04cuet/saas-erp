<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AcademicInstitute extends Model
{
	protected $table = "academic_institutes";
	protected $fillable = [
		'name'
	];
}
