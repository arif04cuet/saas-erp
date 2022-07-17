<?php
/**
 * Created by PhpStorm.
 * User: siam
 * Date: 2/2/19
 * Time: 9:34 PM
 */

namespace App\Repositories;



use App\Entities\Task;

class TaskRepository extends AbstractBaseRepository
{
    protected $modelName = Task::class;
}