<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\Venue;

class VenueRepository extends AbstractBaseRepository
{

    protected $modelName = Venue::class;

}
