<?php

/**
 * Created by VS.
 * User: Araf
 * Date: 03/04/22
 * Time: 5:39 PM
 */

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Scopes\DoptorAbleScope;

trait DoptorAbleTrait
{

    public static function bootDoptorAbleTrait()
    {
        static::creating(function ($model) {
            $model->doptor_id = doptor('id');
        });

        static::addGlobalScope(new DoptorAbleScope);
    }
}
