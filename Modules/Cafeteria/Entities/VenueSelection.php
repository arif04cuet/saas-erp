<?php

namespace Modules\Cafeteria\Entities;

use Modules\TMS\Entities\Training;
use Illuminate\Database\Eloquent\Model;

class VenueSelection extends Model
{
    protected $fillable = [ 'cafeteria_venue_id', 
                            'training_id', 
                            'selection_date', 
                            'food_type', 
                            'total_trainee',
                            'remark' ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function venue() 
    {
        return $this->belongsTo(Venue::class, 'cafeteria_venue_id', 'id');
    }
}
