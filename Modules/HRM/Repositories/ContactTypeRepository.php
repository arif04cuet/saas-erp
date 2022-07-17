<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\ContactType;

class ContactTypeRepository extends AbstractBaseRepository 
{

    protected $modelName = ContactType::class;

}
