<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Contact;

class ContactRepository extends AbstractBaseRepository 
{

    protected $modelName = Contact::class;

}
