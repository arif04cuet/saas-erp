<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/6/19
 * Time: 11:45 AM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\ComplaintInvitation;

class ComplaintInvitationRepository extends AbstractBaseRepository
{
    protected $modelName = ComplaintInvitation::class;
}