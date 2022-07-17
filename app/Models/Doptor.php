<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doptor extends Model
{
    use HasFactory;

    protected $fillable = ['doptor_id', 'name_eng', 'name_bng'];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->name_bng ?? trans('labels.module_title');
        }
        return $this->name_eng ?? trans('labels.module_title');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'doptor_module', 'doptor_id', 'module_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'doptor_id')->withDefault();
    }
}
