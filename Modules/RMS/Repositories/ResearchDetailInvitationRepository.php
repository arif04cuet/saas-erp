<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 4/4/19
 * Time: 1:12 PM
 */

namespace Modules\RMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\RMS\Entities\ResearchDetailInvitation;

class ResearchDetailInvitationRepository extends AbstractBaseRepository
{
    protected $modelName = ResearchDetailInvitation::class;
}