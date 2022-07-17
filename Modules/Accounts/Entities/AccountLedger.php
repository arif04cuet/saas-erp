<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    protected $fillable = ['account_head_id', 'name', 'code', 'opening_balance_type', 'opening_balance', 'closing_balance', 'account_type', 'reconciliation', 'description'];

}
