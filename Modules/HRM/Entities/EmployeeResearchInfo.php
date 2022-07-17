<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeResearchInfo extends Model {
	protected $table = "employee_research_info";
	protected $fillable = [
		"organization_name",
		"research_topic",
		"responsibilities",
		"employee_id",
	];
}
