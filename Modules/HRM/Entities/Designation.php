<?php

namespace Modules\HRM\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Traits\DoptorAbleTrait;

class Designation extends Model
{

    use DoptorAbleTrait;
    
    protected $table = "designations";
    protected $fillable = ['name', 'bangla_name', 'short_name', 'hierarchy_level', 'department_id'];

    public function user()
    {
        return $this->hasManyThrough(User::class, Employee::class, 'designation_id', 'username', 'id', 'employee_id');
    }

    public function getName()
    {
        return App::getLocale() == 'bn' ? (empty($this->bangla_name) ? $this->name : $this->bangla_name) :
            $this->name ?? '';
    }
}
