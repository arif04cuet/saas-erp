<?php


namespace Modules\Publication\Repositories;
use Modules\Publication\Entities\PublicationPress;

use App\Repositories\AbstractBaseRepository;

class PublicationPressRepository extends AbstractBaseRepository {

    protected $modelName = PublicationPress::class;

}
