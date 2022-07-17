<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model {
	protected $modelName = "employee_trainings";
	protected $fillable = [
		"course_name",
		"organization_name",
		"organization_website",
		"duration",
		"training_year",
		"result",
		"organization_country",
		"achievement",
		"employee_id",
		'category',
		'region',
		'nominating_authority'
	];
}
