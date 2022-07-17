<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PublicationAttachment extends Model
{
    protected $table = 'research_publication_attachments';
    protected $fillable = ['id', 'path', 'name', 'ext'];
}
