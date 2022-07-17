<?php
/**
 * Created by PhpStorm.
 * User: araf
 * Date: 6/24/2022
 * Time: 11:25 AM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Section;

class SectionRepository extends AbstractBaseRepository
{
    protected $modelName = Section::class;

}