<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;

class PublishedResearchPaperComment extends Model
{
    protected $fillable = ['published_research_paper_id', 'action', 'remark', 'last_date'];

    public function publishedResearch()
    {
        return $this->belongsTo(PublishedResearchPaper::class, 'published_research_paper_id', 'id');
    }
}
