<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AcademicDegree extends Model
{
	protected $table = "academic_degree";
    protected $fillable = ['name'];
}
