<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HRM\Entities\MailNotification;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCertificateLink;
use Modules\TMS\Repositories\TrainingCertificateLinkRepository;
use MongoDB\Driver\Session;

class TrainingCertificateLinkService
{
    use CrudTrait;

    /**
     * @var TrainingCertificateLinkRepository
     */
    private $trainingCertificateLinkRepository;

    public function __construct(TrainingCertificateLinkRepository $trainingCertificateLinkRepository)
    {
        $this->setActionRepository($trainingCertificateLinkRepository);
    }


    public function getTemplateViewName(Training $training)
    {
        $trainingHead = $training->trainingHead;
        if (is_null($trainingHead)) {
            return 'en';
        }
        if ($trainingHead->level == 'international') {
            return 'international';
        }
        return 'en';
    }

    /**
     * @param string $modelName
     * @param $modelObject
     * @throws \Exception
     */
    public function traineeNullCheck($modelName = '', $modelObject)
    {
        if (is_null($modelObject)) {
            throw new \Exception('Trainee' . $modelName . ' Information Not Found !');
        }
    }

    /**
     * Store Link Related Data For A Trainee
     * @param Training $training
     * @return false
     */
    public function send(Training $training)
    {
        try {
            DB::beginTransaction();
            foreach ($training->trainee as $trainee) {
                $uniqueCode = $this->getUniqueCode();
                $publicLink = $this->getPublicLink($uniqueCode);
                // create or update certificate link
                $certificateLink = TrainingCertificateLink::updateOrCreate(
                    [
                        'trainee_id' => $trainee->id,
                        'training_id' => $training->id
                    ],
                    [
                        'unique_code' => $uniqueCode,
                        'public_link' => $publicLink
                    ]
                );
                // create a mail notification table row
                $this->sendMailNotification($training, $trainee, $certificateLink);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Certificate Link Creation Error: ' . $exception->getMessage());
            \Illuminate\Support\Facades\Session::flash('error', trans('labels.generic_error_message'));
            return false;
        }
    }

    /**
     * @param Training $training
     * @param Trainee $trainee
     * @param TrainingCertificateLink $certificateLink
     */
    public function sendMailNotification(Training $training, Trainee $trainee, TrainingCertificateLink $certificateLink)
    {
        MailNotification::create([
            'email' => $trainee->email,
            'title' => 'Training Certificate For Course "' . $training->getTitle() . '"',
            'message' => 'Your Certificate Code: ' . $certificateLink->unique_code . ' . Please Click Details To View Get Your Certificate',
            'item_url' => $certificateLink->public_link,
        ]);
    }

    //-----------------------------------------------------------------------------------------------------------------
    //                                          Private Function
    //-----------------------------------------------------------------------------------------------------------------

    /**
     * @param $uniqueCode
     * @return string
     */
    private function getPublicLink($uniqueCode)
    {
        return route('training.certificate.show', $uniqueCode);

    }

    /**
     * @return string
     */
    private function getUniqueCode()
    {
        return md5(microtime(true) . mt_Rand());
    }
}

