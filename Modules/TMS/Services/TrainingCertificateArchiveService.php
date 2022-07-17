<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\TrainingRepository;

class TrainingCertificateArchiveService
{
    use CrudTrait;

    private $trainingRepository;
    private $traineeCertificateService;

    public function __construct(
        TrainingRepository $trainingRepository,
        TraineeCertificateService $traineeCertificateService
    ) {
        $this->trainingRepository = $trainingRepository;
        $this->traineeCertificateService = $traineeCertificateService;
        $this->setActionRepository($this->trainingRepository);
    }

    public function certificates(Training $training, TrainingCourse $course)
    {
        $data = [];
        $training = $this->trainingRepository->findOne($training->id, 'trainee');
        $certificateLocalName = $this->getTrainingCertiticateLocalName($training, $course);
        foreach ($training->trainee as $trainee) {
            $data[] = $this->traineeCertificateService->getCertificateData($trainee, $course, $certificateLocalName);
        }
        return $data;
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return string
     */
    public function getTrainingCertiticateLocalName(Training $training, TrainingCourse $course): string
    {
        return $this->traineeCertificateService->getCertificateLocal($training, $course);
    }

    public function getTrainingLevel(Training $training)
    {
        $trainingHead = $training->trainingHead;
        if (!is_null($trainingHead)) {
            return $trainingHead->level ?? 'national';
        }
        return 'national';

    }
}
