<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeePublication extends Model {
	protected $table = "employee_publications";
	protected $fillable = [
		"type_of_publication",
		"author_name",
		"publication_title",
		"publication_company",
		"publication_company_location",
		"published_date",
		"source_link",
		"employee_id",
	];
}
