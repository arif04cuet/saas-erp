<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Services\TraineeCertificateService;
use Modules\TMS\Services\TrainingCertificateArchiveService;

class TrainingCertificateArchiveController extends Controller
{
    private $service;

    const MAX_ARCHIVE_NUMBER = 80;

    public function __construct(TrainingCertificateArchiveService $trainingCertificateArchiveService)
    {
        $this->service = $trainingCertificateArchiveService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('tms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::create');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return Factory|View
     */
    public function show(Training $training, TrainingCourse $course)
    {
        $data = collect($this->service->certificates($training, $course))->take($this::MAX_ARCHIVE_NUMBER);
        $local = $this->service->getTrainingCertiticateLocalName($training, $course);
        return view('tms::trainee.certificate.' . $local, compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('tms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
