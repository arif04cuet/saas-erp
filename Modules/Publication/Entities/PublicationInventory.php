<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;

class PublicationInventory extends Model
{
    protected $table = "publication_inventories";
    protected $fillable = ['published_research_paper_id', 'available_amount', 'previous_amount', 'status'];

    public function publication()
    {
        return $this->belongsTo(PublishedResearchPaper::class, 'published_research_paper_id', 'id');
    }
}
