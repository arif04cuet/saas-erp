<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class HostelBudgetTitle extends Model {
	protected $fillable = ['name', 'current_year', 'status'];

	public function hostelBudgets() {
		return $this->hasMany( HostelBudget::class );
	}

}
