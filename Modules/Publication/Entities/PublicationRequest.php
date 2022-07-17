<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\RMS\Entities\Research;
use Modules\Publication\Entities\PublishedResearchPaper;

class PublicationRequest extends Model
{
    protected $fillable = ['research_id', 'status', 'remark', 'researcher_remark'];

    public function research()
    {
        return $this->belongsTo(Research::class);
    }

    public function publishedResearchPaper()
    {
        return $this->belongsTo(PublishedResearchPaper::class, 'id', 'publication_request_id');
    }
}
