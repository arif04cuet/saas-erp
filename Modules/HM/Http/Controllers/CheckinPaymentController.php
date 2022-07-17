<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Emails\SendPaymentInfoMail;
use Modules\HM\Entities\CheckinPayment;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Http\Requests\StoreCheckinPaymentRequest;
use Modules\HM\Services\CheckinPaymentService;
use Modules\HM\Services\CheckinService;
use Modules\TMS\Services\TrainingsService;

class CheckinPaymentController extends Controller
{
    /**
     * @var CheckinPaymentService
     */
    private $checkinPaymentService;
    /**
     * @var CheckinService
     */
    private $checkinService;
    /**
     * @var TrainingsService
     */
    private $trainingService;

    /**
     * CheckinPaymentController constructor.
     * @param CheckinPaymentService $checkinPaymentService
     * @param TrainingsService $trainingService
     * @param CheckinService $checkinService
     */
    public function __construct(
        CheckinPaymentService $checkinPaymentService,
        TrainingsService $trainingService,
        CheckinService $checkinService
    ) {
        $this->checkinPaymentService = $checkinPaymentService;
        $this->checkinService = $checkinService;
        $this->trainingService = $trainingService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index(RoomBooking $roomBooking)
    {
        if ($roomBooking->type != 'checkin') {
            abort(404);
        }
        $training = null;
        $participantTypes = null;
        $sponsors = null;
        $totalBill = $this->checkinService->getTotalBill($roomBooking);
        $dueAmount = $this->checkinService->getDueAmount($roomBooking);
        if ($roomBooking->booking_type == RoomBooking::getBookingTypes()['training']) {
            $training = $roomBooking->training;
            $participantTypes = $this->trainingService->getTrainingParticipantsByTraining($training);
            $sponsors = $this->trainingService->getTrainingSponsorsByTraining($training);
            $training->totel_registered_trainee = $this->trainingService->getTotelRegistaredTrainee($training);
        }

        return view('hm::check-in.payment.index')->with([
            'checkin' => $roomBooking,
            'totalBill' => $totalBill,
            'dueAmount' => $dueAmount,
            'training' => $training,
            'participantTypes' => $participantTypes,
            'sponsors' => $sponsors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param RoomBooking $roomBooking
     * @return Response
     */
    public function create(RoomBooking $roomBooking)
    {
        $duration = $this->checkinService->getCheckedInDuration($roomBooking);
        $dueAmount = $this->checkinService->getDueAmount($roomBooking);

        return view('hm::check-in.payment.create')->with([
            'checkin' => $roomBooking,
            'duration' => $duration,
            'dueAmount' => $dueAmount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCheckinPaymentRequest $request
     * @param RoomBooking $roomBooking
     * @return Response
     */
    public function store(StoreCheckinPaymentRequest $request, RoomBooking $roomBooking)
    {
        if ($roomBooking->type != 'checkin') {
            abort(404);
        }

        $checkinPayment = $this->checkinPaymentService->save(
            array_merge(
                $request->all(),
                [
                    'checkin_id' => $roomBooking->id,
                    'shortcode' => time()
                ]
            )
        );

        $duration = $this->checkinService->getCheckedInDuration($roomBooking);

        if ($checkinPayment && !empty($roomBooking->requester->email)) {
            Mail::to($roomBooking->requester->email)->send(new SendPaymentInfoMail($roomBooking, $request->amount,
                $request->type, $duration));
        }

        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('check-in-payments.index', $checkinPayment->checkin_id);
    }

    /**
     * Show the specified resource.
     * @param RoomBooking $roomBooking
     * @param CheckinPayment $checkinPayment
     * @return Response
     */
    public function show(RoomBooking $roomBooking, CheckinPayment $checkinPayment)
    {
        return view('hm::check-in.payment.show')->with(['checkin' => $roomBooking, $checkinPayment]);
    }
}
