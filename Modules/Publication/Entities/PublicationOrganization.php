<?php

namespace Modules\Publication\Entities;

use Modules\HRM\Entities\Employee;
use Illuminate\Database\Eloquent\Model;

class PublicationOrganization extends Model
{
    protected $table = "publication_organizations";

    protected $fillable = ['name_en', 'name_bn', 'status', 'organization_head'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'organization_head', 'id');
    }
}
