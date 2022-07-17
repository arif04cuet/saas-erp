<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 3/4/19
 * Time: 12:02 PM
 */

namespace App\Repositories\Sharing;


use App\Entities\Sharing\ShareConversation;
use App\Repositories\AbstractBaseRepository;

class ShareConversationRepository extends AbstractBaseRepository
{
    protected $modelName = ShareConversation::class;
}