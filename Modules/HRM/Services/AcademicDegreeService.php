<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/29/2018
 * Time: 4:16 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Modules\HRM\Repositories\AcademicDegreeRepository;

class AcademicDegreeService {
	use CrudTrait;
	private $academicDegreeRepository;

	public function __construct( AcademicDegreeRepository $academicDegreeRepository ) {
		$this->academicDegreeRepository = $academicDegreeRepository;
		$this->setActionRepository( $this->academicDegreeRepository );
	}
	public function getAcademicDegree() {
		$academicDegree          = $this->academicDegreeRepository->findAll()->pluck( 'name', 'id' )->toArray();
		$academicDegree['other_degree'] = 'Other\'s';

		return $academicDegree;
	}

	public function storeAcademicDegree( $data ) {

		$degree = $this->save( $data );
		return $degree;
	}

}