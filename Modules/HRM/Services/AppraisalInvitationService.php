<?php

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Repositories\AppraisalInvitationRepository;

class AppraisalInvitationService
{
    use CrudTrait;

    /**
     * @var AppraisalInvitationRepository
     */
    private $appraisalInvitationRepository;

    public function __construct(AppraisalInvitationRepository $appraisalInvitationRepository)
    {

        /** @var AppraisalInvitationRepository $appraisalInvitationRepository */
        $this->appraisalInvitationRepository = $appraisalInvitationRepository;
        $this->setActionRepository($appraisalInvitationRepository);
    }

    public function getMemorandumNumber()
    {
        $prefix = '47.63.0000.041.21.001.';
        $memorandum = $prefix.date('yms');
        return $memorandum;
    }
    

    public function storeInvitation(array $data)
    {
        return DB::transaction(function() use ($data){
            $data = $this->createDateFromFormat($data, [
                'deadline_to_signer' => 'j F, Y',
                'deadline_to_final_commenter' => 'j F, Y',
                'deadline_final_commenter_sign' => 'j F, Y'
            ]);
            return $this->save($data);
        });
    }

    private function createDateFromFormat($data, $keys = [])
    {
        foreach ($keys as $key => $value) {
            $data[$key] = Carbon::createFromFormat($value, $data[$key]);
        }
        return $data;
    }
}
