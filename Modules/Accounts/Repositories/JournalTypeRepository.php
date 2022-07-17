<?php


namespace Modules\Accounts\Repositories;

use Modules\Accounts\Entities\JournalType;
use App\Repositories\AbstractBaseRepository;

class JournalTypeRepository extends AbstractBaseRepository
{
    protected $modelName = JournalType::class;

}
