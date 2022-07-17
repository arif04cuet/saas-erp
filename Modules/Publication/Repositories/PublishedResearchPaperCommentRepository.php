<?php


namespace Modules\Publication\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Publication\Entities\PublishedResearchPaperComment;

class PublishedResearchPaperCommentRepository extends AbstractBaseRepository
{

    protected $modelName = PublishedResearchPaperComment::class;

}
