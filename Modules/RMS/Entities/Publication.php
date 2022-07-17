<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'research_publications';

    protected $fillable = ['id', 'research_id', 'description'];

    public function attachments()
    {
        return $this->hasMany(PublicationAttachment::class, 'research_publication_id', 'id');
    }

    public function research()
    {
        return $this->belongsTo(Research::class, 'research_id', 'id');
    }
}
