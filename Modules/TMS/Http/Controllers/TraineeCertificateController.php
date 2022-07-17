<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Services\TraineeCertificateService;
use Modules\TMS\Services\TraineeService;

class TraineeCertificateController extends Controller
{
    /**
     * @var TraineeCertificateService
     */
    private $traineeCertificateService;


    public function __construct(TraineeCertificateService $traineeCertificateService)
    {
        $this->traineeCertificateService = $traineeCertificateService;
    }

    public function show(Trainee $trainee, TrainingCourse $course, string $local)
    {
        $data[] = $this->traineeCertificateService->getCertificateData($trainee, $course, $local);
        // dd($local);
        return view('tms::trainee.certificate.' . $local, compact(
                'course',
                'data'
            )
        );
    }
}
