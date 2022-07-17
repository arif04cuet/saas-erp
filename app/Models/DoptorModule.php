<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoptorModule extends Model
{
    use HasFactory;
    protected $table = 'doptor_module';
    protected $fillable = ['doptor_id', 'module_id'];
}
