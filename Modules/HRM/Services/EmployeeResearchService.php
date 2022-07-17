<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/5/2018
 * Time: 11:46 AM
 */

namespace Modules\HRM\Services;


use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Modules\HRM\Repositories\EmployeeResearchRepository;

class EmployeeResearchService {
	use  CrudTrait;
	protected $employeeResearchRepository;

	public function __construct( EmployeeResearchRepository $employeeResearchRepository ) {
		$this->employeeResearchRepository = $employeeResearchRepository;
		$this->setActionRepository($this->employeeResearchRepository);
	}

	public function storeResearchInfo( $researchInfo ) {
		foreach ( $researchInfo as $research ) {
			$research = $this->employeeResearchRepository->save($research);

		}
		return new DataResponse( $research, $research['employee_id'], 'Research information added successfully' );

	}
	public function updateResearchInfo( $data, $employeeId ) {

		$existingEducationsIds = $this->getEmployeeResearchIds( $employeeId );
		$newEducationIds       = array_column( $data, 'id' );
		$deletedIds            = array_diff( $existingEducationsIds, $newEducationIds );
		if ( count( $deletedIds ) > 0 ) {
			foreach ( $deletedIds as $deleted_id ) {
				$research = $this->findOrFail( $deleted_id );
				$status    = $research->delete();
			}
		}

		foreach ( $data as $item ) {
			if ( isset( $item['id'] ) ) {
				$research = $this->findOrFail( $item['id'] );
				$status    = $research->update( $item );
			} else {
				$research = $this->employeeResearchRepository->save( $item );
				$status    = true;
			}
		}
		if ( $status ) {
			return new DataResponse( $research, $research['employee_id'], 'Research information updated successfully' );
		} else {
			return new DataResponse( $research, $research['employee_id'], 'Something going wrong !', 500 );
		}
	}

	public function getEmployeeResearchIds( $employeeId ) {

		$educations = $this->employeeResearchRepository->findBy( [ 'employee_id' => $employeeId ] )->pluck( 'employee_id', 'id' )->toArray();

		return array_keys( $educations );
	}
}