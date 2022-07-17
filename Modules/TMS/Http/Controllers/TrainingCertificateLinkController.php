<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TrainingCertificateLinkService;
use MongoDB\Driver\Session;

class TrainingCertificateLinkController extends Controller
{
    /**
     * @var TrainingCertificateLinkService
     */
    private $trainingCertificateLinkService;

    public function __construct(TrainingCertificateLinkService $trainingCertificateLinkService)
    {
        $this->trainingCertificateLinkService = $trainingCertificateLinkService;
    }

    /**
     * @param $uniqueCode
     * @return Factory|Application|RedirectResponse|View
     */
    public function show($uniqueCode)
    {
        try {
            $trainingCertificateLink = $this->trainingCertificateLinkService->findBy(['unique_code' => $uniqueCode])
                ->first();
            if (is_null($trainingCertificateLink)) {
                $message = trans('tms::certificate.link.flash_messages.not_found', ['code' => $uniqueCode]);
                throw new \Exception($message);
            }
            // get trainee info
            $trainee = $trainingCertificateLink->trainee;
            $this->trainingCertificateLinkService->traineeNullCheck('', $trainee);
            // get general info
            $traineeGeneralInfo = $trainee->generalInfos;
            $this->trainingCertificateLinkService->traineeNullCheck('GeneralInformation', $trainee);
            // get service info
            $traineeService = $trainee->services;
            $this->trainingCertificateLinkService->traineeNullCheck('Service', $trainee);
            // get training info
            $training = $trainee->training;
            $this->trainingCertificateLinkService->traineeNullCheck('Training', $trainee);
            // get template name
            $templateViewName = $this->trainingCertificateLinkService->getTemplateViewName($training);
            // get course
            $course = $training->courses->first();
            // prepare data
            $englishName = ucwords(strtolower($trainee->english_name));
            $designation = ucwords(strtolower($traineeService->designation ?? trans('labels.not_found')));
            $fatherName = ucwords(strtolower($traineeGeneralInfo->fathers_name ?? trans('labels.not_found')));
            $motherName = ucwords(strtolower($traineeGeneralInfo->mothers_name ?? trans('labels.not_found')));
            $presentAddress = ucwords(strtolower($traineeGeneralInfo->present_address ?? trans('labels.not_found')));
            $organization = $traineeService->organization ?? trans('labels.not_found');
            $trainingStartDate = Carbon::parse($training->start_date)->format('d/m/Y');
            $trainingEndDate = Carbon::parse($training->end_date)->format('d/m/Y');
            $sponsors = $training->trainingOrganizations->map(function ($org) {
                return $org->name;
            })->implode(', ');
            $currentDate = Carbon::now()->format('d/m/Y');
            return view('tms::trainee.certificate.' . $templateViewName, compact('trainee',
                    'designation',
                    'englishName',
                    'course',
                    'fatherName',
                    'motherName',
                    'presentAddress',
                    'organization',
                    'sponsors',
                    'trainingStartDate',
                    'trainingEndDate',
                    'currentDate'
                )
            );
        } catch (Exception $exception) {
            \Illuminate\Support\Facades\Session::flash('error', $exception->getMessage());
            return redirect()->route('training.certificate.verify');
        }
    }

    /**
     * @return Factory|Application|View
     */
    public function verify()
    {
        return view('tms::training.certificate.link.verify');
    }

    /**
     * @param Training $training
     */
    public function send(Training $training)
    {
        if ($this->trainingCertificateLinkService->send($training)) {
            \Illuminate\Support\Facades\Session::flash('success',
                trans('tms::certificate.link.flash_messages.send_success'));
            return redirect()->back();
        } else {
            if (!\Illuminate\Support\Facades\Session::has('error')) {
                \Illuminate\Support\Facades\Session::flash('error', trans('labels.generic_error_message'));
            }
            return redirect()->back();
        }
    }
}
