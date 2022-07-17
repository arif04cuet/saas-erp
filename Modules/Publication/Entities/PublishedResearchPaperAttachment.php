<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;

class PublishedResearchPaperAttachment extends Model
{
    protected $fillable = ['published_research_paper_id', 'attachment', 'file_name', 'type'];
}
