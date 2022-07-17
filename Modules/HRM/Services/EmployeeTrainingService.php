<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/4/2018
 * Time: 7:51 PM
 */

namespace Modules\HRM\Services;


use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Modules\HRM\Repositories\EmployeeTrainingRepository;

class EmployeeTrainingService {
	use CrudTrait;
	protected $employeeTrainingRepository;

	public function __construct( EmployeeTrainingRepository $employeeTrainingRepository ) {
		$this->employeeTrainingRepository = $employeeTrainingRepository;
		$this->setActionRepository( $this->employeeTrainingRepository );
	}

	public function StoreTrainingInfo( $trainings ) {

	    if(!is_null($trainings) && count($trainings)) {

	        foreach ( $trainings as $training ) {
                $trainingInfo = $this->employeeTrainingRepository->save( $training );
            }

            return new DataResponse( $trainingInfo, $trainingInfo['employee_id'], trans('labels.Training information added successfully'));
        }

        return new DataResponse($trainings, null, trans('labels.You have not added any training information'));

	}

	public function updateTrainingInfo( $data, $employeeId ) {

//		sometime full section can be removed while edit. so deleting the section
		$existingEducationsIds = $this->getEmployeeTrainingIds( $employeeId );
		$newEducationIds       = (!is_null($data) && count($data)) ? array_column( $data, 'id' ) : [];
		$deletedIds            = array_diff( $existingEducationsIds, $newEducationIds );
		if ( count( $deletedIds ) > 0 ) {
			foreach ( $deletedIds as $deleted_id ) {
				$training = $this->findOrFail( $deleted_id );
				$status   = $training->delete();
			}
		}
//deleting end

		$status = false;
		if(!is_null($data) && count($data)) {
            foreach ( $data as $item ) {
                if ( isset( $item['id'] ) ) {
//				existing training updating
                    $training = $this->findOrFail( $item['id'] );
                    $status   = $training->update( $item );
                } else {
//				creating new one while add new training on update mode
                    $training = $this->employeeTrainingRepository->save( $item );
                    $status   = true;
                }
            }
        }

		if ( $status ) {
			return new DataResponse( $training, $training['employee_id'], trans('labels.Training information updated successfully'));
		} else {
			return new DataResponse( $data, null, trans('labels.You have not added any training information'), 500 );
		}
	}

	public function getEmployeeTrainingIds( $employeeId ) {

		$trainingIds = $this->employeeTrainingRepository->findBy( [ 'employee_id' => $employeeId ] )->pluck( 'employee_id', 'id' )->toArray();

		return array_keys( $trainingIds );
	}

	public function getTrainingDuration() {
		return $this->employeeTrainingRepository->getEmployeeTrainingDuration();
	}

}