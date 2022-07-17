<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;

class PublishedResearchPaper extends Model
{
    protected $fillable = ['publication_type_id', 'publication_press_id', 'publication_request_id', 'quantity', 'proof_status', 'status', 'remark'];

    public function publicationPress()
    {
        return $this->belongsTo(PublicationPress::class);
    }

    public function publicationRequest()
    {
        return $this->belongsTo(PublicationRequest::class);
    }

    public function publishedResearchComments()
    {
        return $this->hasMany(PublishedResearchPaperComment::class);
    }

    public function publishedWorkOrderAttachment()
    {
        return $this->hasOne(PublishedResearchPaperAttachment::class)->where('type', '=', 'workorder');
    }

    public function publishedFinalAttachments()
    {
        return $this->hasMany(PublishedResearchPaperAttachment::class)->where('type', '=', 'book');
    }

    public function inventory()
    {
        return $this->belongsTo(PublicationInventory::class, 'id', 'published_research_paper_id');
    }
}
