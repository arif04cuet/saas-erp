<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/24/19
 * Time: 6:48 PM
 */

namespace Modules\RMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\RMS\Entities\Research;

class ResearchRepository extends  AbstractBaseRepository
{
    protected $modelName = Research::class;
}