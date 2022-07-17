<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/4/2018
 * Time: 7:51 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\EmployeeTraining;

class EmployeeTrainingRepository extends AbstractBaseRepository {
	protected $modelName = EmployeeTraining::class;

	public function getEmployeeTrainingDuration() {
		return [
			'1 Day'   => '1 Day',
			'2 Days'  => '2 Days',
			'3 Days'  => '3 Days',
			'1 Week'  => '1 Week',
			'2 Week'  => '2 Week',
			'3 Week'  => '3 Week',
			'4 Week'  => '4 Week',
			'5 Week'  => '5 Week',
			'6 Week'  => '6 Week',
			'7 Week'  => '7 Week',
			'8 Week'  => '8 Week',
			'3 Month' => '3 Month',
			'6 Month' => '6 Month'
		];
	}
}