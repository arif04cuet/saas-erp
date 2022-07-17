<?php


namespace Modules\Publication\Repositories;
use Modules\Publication\Entities\PublicationType;

use App\Repositories\AbstractBaseRepository;

class PublicationTypeRepository extends AbstractBaseRepository {

    protected $modelName = PublicationType::class;

}
