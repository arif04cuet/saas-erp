<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Entities\User')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Entities\Permission')->withTimestamps();
    }

    public function hasPermission($name, $modelName)
    {
        if ($this->permissions()->where('name', $name)->where('model_name', $modelName)->first()) {
            return true;
        }
        return false;
    }
}
