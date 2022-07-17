<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['name_en', 'name_bn', 'slug', 'short_code'];

    public function doptors()
    {        
        return $this->belongsToMany(Doptor::class, 'doptor_module', 'doptor_id', 'module_id');
    }
}
