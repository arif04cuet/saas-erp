<?php
namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\RegisteredTraineeEmergency;
use Modules\TMS\Entities\RegisteredTraineeServiceInfo;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Repositories\TraineeEmergencyContactRepository;

class TraineeEmergencyContactService
{
    use CrudTrait;

    /**
     * @var TraineeEmergencyContactRepository
     */
    private $traineeEmergencyContactRepository;

    public function __construct(TraineeEmergencyContactRepository $traineeEmergencyContactRepository)
    {
        /** @var TraineeEmergencyContactRepository $traineeEmergencyContactRepository */
        $this->traineeEmergencyContactRepository = $traineeEmergencyContactRepository;
        $this->setActionRepository($traineeEmergencyContactRepository);
    }

    public function storeEmergencyContact(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            if (array_key_exists('mobile_no', $data)) {
                $data['mobile_no'] = bn2enNumber($data['mobile_no']);
            }

            $contact = new RegisteredTraineeEmergency($data);
            return $trainee->emergencyContacts()->save($contact);
        });
    }

    public function updateContact(Trainee $trainee, array $data)
    {
        return DB::transaction(function () use ($trainee, $data){
            if (array_key_exists('mobile_no', $data)) {
                $data['mobile_no'] = bn2enNumber($data['mobile_no']);
            }
            return $trainee->emergencyContacts->update($data);
        });
    }
}
