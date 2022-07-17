<?php


namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\CalendarEvent;

class CalendarEventRepository extends AbstractBaseRepository
{
    protected $modelName = CalendarEvent::class;
}