<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeLoanCircular extends Model
{

    protected $fillable = ['reference_no', 'title', 'circular_date', 'last_date_of_application', 'details', 'status'];
}
