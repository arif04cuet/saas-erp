<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/28/2018
 * Time: 4:54 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Modules\HRM\Repositories\AcademicDepartmentRepository;

class AcademicDepartmentService {
	use CrudTrait;
	private $academicDepartmentRepository;

	public function __construct( AcademicDepartmentRepository $academicDepartmentRepository ) {
		$this->academicDepartmentRepository = $academicDepartmentRepository;
		$this->setActionRepository( $this->academicDepartmentRepository );
	}

	public function getAcademicDepartments() {
		$academicDepartments          = $this->academicDepartmentRepository->findAll()->pluck( 'name', 'id' )->toArray();
		$academicDepartments['other_department'] = 'Other\'s';

		return $academicDepartments;
	}
	public function storeAcademicDepartment( $data ) {

		$department = $this->save( $data );
		return $department;
	}

}