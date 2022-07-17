<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DoptorAbleTrait;

class Section extends Model
{

    use DoptorAbleTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'section_code', 'section_head_employee_id', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function head()
    {
        return $this->belongsTo(Employee::class, 'section_head_employee_id', 'id');
    }

}
