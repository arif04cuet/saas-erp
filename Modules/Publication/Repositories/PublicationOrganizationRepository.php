<?php


namespace Modules\Publication\Repositories;

use Modules\Publication\Entities\PublicationOrganization;
use App\Repositories\AbstractBaseRepository;

class PublicationOrganizationRepository extends AbstractBaseRepository
{
    protected $modelName = PublicationOrganization::class;
}
