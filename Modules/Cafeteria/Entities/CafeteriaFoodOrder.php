<?php

namespace Modules\Cafeteria\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;

class CafeteriaFoodOrder extends Model
{
    protected $fillable = [
        'title',
        'order_date',
        'requester',
        'reference_type',
        'bill_to',
        'status',
        'paid_amount',
        'remarks',
        'note'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'bill_to', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'bill_to', 'id');
    }

    public function foodOrderItems()
    {
        return $this->hasMany(CafeteriaFoodOrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'requester', 'id');
    }
}
