<?php


namespace Modules\Publication\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Publication\Entities\PublishedResearchPaperAttachment;

class PublishedResearchPaperAttachmentRepository extends AbstractBaseRepository
{

    protected $modelName = PublishedResearchPaperAttachment::class;

}
