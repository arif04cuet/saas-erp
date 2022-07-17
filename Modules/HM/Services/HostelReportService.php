<?php


namespace Modules\HM\Services;


use App\Traits\CrudTrait;

class HostelReportService
{
    use CrudTrait;

    /**
     * @param BookingRequestService $bookingRequestService
     * @param CheckinService $checkinService
     */

    private $bookingRequestService;
    private $checkinService;

    public function __construct(BookingRequestService $bookingRequestService, CheckinService $checkinService)
    {
        $this->bookingRequestService = $bookingRequestService;
        $this->checkinService = $checkinService;

    }

    public function getCollectionRegisterReport(array $filterBy)
    {
        $checkIns = $this->bookingRequestService->findBy(['type' => 'checkin'],
            ['training'])->whereBetween('start_date', $filterBy);
        $checkInData = [];
        $masterData = [];
        $grandBill = 0.0;
        $grandPaidAmount = 0.0;
        $grandDueAmount = 0.0;
        foreach ($checkIns as $checkin) {
            $totalBill = $this->checkinService->getTotalBill($checkin);
            $dueAmount = $this->checkinService->getDueAmount($checkin);
            $paidAmount = $totalBill - $dueAmount;
            $grandBill += $totalBill;
            $grandPaidAmount += $paidAmount;
            $grandDueAmount += $dueAmount;
            $trainingTitle = isset($checkin['training']['title']) ? $checkin['training']['title'] : '';
            $is_training = !empty($checkin['training']['id']) ? true : false;
            $data = [
                'id' => $checkin->id,
                'shortcode' => $checkin->shortcode,
                'total_bill' => $totalBill,
                'paid_amount' => $paidAmount,
                'due_amount' => $dueAmount,
                'is_training' => $is_training,
                'training_title' => $trainingTitle,
            ];
            $checkInData[] = $data;
        }
        $masterData['grand_bill'] = $grandBill;
        $masterData['grand_paid_amount'] = $grandPaidAmount;
        $masterData['grand_due_amount'] = $grandDueAmount;
        $masterData['data'] = $checkInData;
        return $masterData;
    }

    public function getPrintData(array $filterBy)
    {
        $data = $this->getCollectionRegisterReport($filterBy);

        $courseTotalAmount = 0;
        $coursePaidAmount = 0;
        $courseDueAmount = 0;
        $otherTotalBill = 0;
        $otherDueAmount = 0;
        $otherPaidAmount = 0;
        foreach ($data['data'] as $item) {
            if ($item['is_training']) {
                $courseTotalAmount += $item['total_bill'];
                $courseDueAmount += $item['due_amount'];
                $coursePaidAmount += $item['paid_amount'];
            } else {
                $otherTotalBill += $item['total_bill'];
                $otherDueAmount += $item['due_amount'];
                $otherPaidAmount += $item['paid_amount'];
            }
        }
        $data = [
            'course_due_amount' => $courseDueAmount,
            'other_due_amount' => $otherDueAmount,
            'total_due_amount' => $courseDueAmount + $otherDueAmount,
            'course_paid_amount' => $coursePaidAmount,
            'other_paid_amount' => $otherPaidAmount,
            'total_paid_amount' => $coursePaidAmount + $otherPaidAmount,
        ];
        return $data;
    }
}
