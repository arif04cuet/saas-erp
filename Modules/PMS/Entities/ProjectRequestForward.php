<?php

namespace Modules\PMS\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class ProjectRequestForward extends Model
{
    public $table = 'project_request_forward';
    protected $fillable = ['project_request_id','forward_to'];

    public function projectRequest()
    {
        return $this->belongsTo('Modules\PMS\Entities\ProjectRequest', 'project_request_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'forward_to');
    }
}
