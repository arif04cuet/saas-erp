<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Department;

class Journal extends Model
{
    protected $fillable = ['name', 'debit_account_id', 'credit_account_id', 'department_id', 'type_id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function type()
    {
        return $this->belongsTo(JournalType::class, 'type_id', 'id')->withDefault();
    }

    public function account()
    {
        return $this->belongsTo(EconomyCode::class, 'account_id', 'code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault();
    }

    public function debitAccount()
    {
        return $this->belongsTo(EconomyCode::class, 'debit_account_id', 'code');
    }

    public function creditAccount()
    {
        return $this->belongsTo(EconomyCode::class, 'credit_account_id', 'code');
    }

}
