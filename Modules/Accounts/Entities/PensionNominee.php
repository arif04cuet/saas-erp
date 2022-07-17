<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Modules\HRM\Entities\Employee;

class PensionNominee extends Model
{
    protected $fillable = [
        'employee_id',
        'name',
        'bangla_name',
        'birth_date',
        'relation',
        'age_limit',
        'remark',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function nominees()
    {
        return $this->hasMany(PensionNominee::class, 'employee_id', 'employee_id');
    }

    public function getNomineeInfo()
    {
        $lang = App::getLocale();
        $name = ($lang == 'bn' ? $this->bangla_name : $this->name);
        $relation = $this->relation;
        return $name . ' <br>'. __('accounts::pension.nominee.relation'). ': ' . $relation;
    }
}
