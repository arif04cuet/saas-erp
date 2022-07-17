<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 03/04/19
 * Time: 16:32
 */

namespace Modules\RMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\RMS\Entities\ResearchDetailSubmissionAttachment;


class ResearchDetailSubmissionAttachmentRepository extends AbstractBaseRepository
{
    protected $modelName = ResearchDetailSubmissionAttachment::class;

}