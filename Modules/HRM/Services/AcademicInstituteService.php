<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/25/2018
 * Time: 6:03 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Modules\HRM\Repositories\AcademicInstituteRepository;
use Modules\HRM\Repositories\InstituteRepository;

class AcademicInstituteService {
	use CrudTrait;
	private $academicInstituteRepository;


	public function __construct( AcademicInstituteRepository $academicInstituteRepository ) {
		$this->academicInstituteRepository = $academicInstituteRepository;
		$this->setActionRepository( $this->academicInstituteRepository );
	}

	public function getInstitutes() {
		$institutes          = $this->academicInstituteRepository->findAll()->pluck( 'name', 'id' )->toArray();
		$institutes['other'] = 'Other\'s';

		return $institutes;
	}

	public function storeInstitute( $data ) {
		$institute = $this->save( $data );

		return $institute;
	}

	public function getDegreeDuration() {
		return [
			'1 year'   => '1 year',
			'2 years'  => '2 years',
			'3 years'  => '3 years',
			'4 years'  => '4 years',
			'5 years'  => '5 years',
			'6 years'  => '6 years',
			'7 years'  => '7 years',
			'8 years'  => '8 years',
			'9 years'  => '9 years',
			'10 years' => '10 years',
		];
	}

}