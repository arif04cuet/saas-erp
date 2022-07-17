<?php

namespace Modules\Publication\Entities;

use Modules\HRM\Entities\Employee;
use Modules\Publication\Entities\PublicationOrganization;
use Illuminate\Database\Eloquent\Model;

class ResearchPaperFreeRequest extends Model
{
    protected $table = "research_paper_free_requests";

    protected $fillable = [
        'published_research_paper_id', 'requester_id', 'reference_type', 'reference_id', 'application_type', 'status', 'remark', 'quantity'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'reference_id', 'id');
    }
    public function organization()
    {
        return $this->belongsTo(PublicationOrganization::class, 'reference_id', 'id');
    }
    public function publication()
    {
        return $this->belongsTo(PublishedResearchPaper::class, 'published_research_paper_id', 'id');
    }
}
