<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/5/2018
 * Time: 11:31 AM
 */

namespace Modules\HRM\Services;


use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Modules\HRM\Repositories\EmployeePublicationRepository;

class EmployeePublicationService {
	use CrudTrait;
	protected $employeePublicationRepository;

	public function __construct( EmployeePublicationRepository $employeePublicationRepository ) {
		$this->employeePublicationRepository = $employeePublicationRepository;
		$this->setActionRepository( $this->employeePublicationRepository );
	}

	public function storePublicationInfo( $publications ) {
		foreach ( $publications as $publication ) {
            if(!is_null($publication['published_date'])) $publication ['published_date'] = date('Y-m-d' , strtotime($publication['published_date']));
			$publication = $this->employeePublicationRepository->save( $publication );
		}

		return new DataResponse( $publication, $publication['employee_id'], 'Publication information added successfully' );

	}

	public function updatePublicationInfo( $data, $employeeId ) {

		$existingPublicationIds = $this->getEmployeePublicationIds( $employeeId );
		$newPublicationIds       = array_column( $data, 'id' );
		$deletedIds            = array_diff( $existingPublicationIds, $newPublicationIds );
		if ( count( $deletedIds ) > 0 ) {
			foreach ( $deletedIds as $deleted_id ) {
				$publication = $this->findOrFail( $deleted_id );
				$status    = $publication->delete();
			}
		}

		foreach ( $data as $item ) {
            if(!is_null($item['published_date'])) $item ['published_date'] = date('Y-m-d' , strtotime($item['published_date']));
			if ( isset( $item['id'] ) ) {
				$publication = $this->findOrFail( $item['id'] );
				$status    = $publication->update( $item );
			} else {
				$publication = $this->employeePublicationRepository->save( $item );
				$status    = true;
			}
		}
		if ( $status ) {
			return new DataResponse( $publication, $publication['employee_id'], 'Publication information updated successfully' );
		} else {
			return new DataResponse( $publication, $publication['employee_id'], 'Something going wrong !', 500 );
		}
	}

	public function getEmployeePublicationIds( $employeeId ) {

		$publications = $this->employeePublicationRepository->findBy( [ 'employee_id' => $employeeId ] )->pluck( 'employee_id', 'id' )->toArray();

		return array_keys( $publications );
	}

}