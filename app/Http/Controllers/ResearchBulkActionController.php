<?php

namespace App\Http\Controllers;

use App\Constants\WorkflowStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\RMS\Services\ResearchDetailSubmissionService;
use Modules\RMS\Services\ResearchProposalSubmissionService;

class ResearchBulkActionController extends Controller
{
    private $researchProposalSubmissionService;
    private $researchDetailSubmissionService;

    public function __construct(ResearchProposalSubmissionService $researchProposalSubmissionService,
                                ResearchDetailSubmissionService $researchDetailSubmissionService)
    {
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
        $this->researchDetailSubmissionService = $researchDetailSubmissionService;

    }

    public function researchBulkAction(Request $request)
    {
        foreach ($request->items as $item) {
            $featureName = explode('|', $item)[0];
            $itemAndShareId = explode('|', $item)[1];
            if ($featureName == config('rms.research_proposal_detail_feature')) {
                if ($request->action_type == WorkflowStatus::APPROVED) {
                    $this->researchDetailSubmissionService->researchDetailApproved($itemAndShareId);
                } elseif ($request->action_type == WorkflowStatus::REJECTED) {
                    $this->researchDetailSubmissionService->researchDetailReject($itemAndShareId);
                }
            } elseif ($featureName == Config::get('constants.research_proposal_feature_name')) {
                if ($request->action_type == WorkflowStatus::APPROVED) {
                    $this->researchProposalSubmissionService->researchProposalApproved($itemAndShareId);
                } elseif ($request->action_type == WorkflowStatus::REJECTED) {
                    $this->researchProposalSubmissionService->researchProposalReject($itemAndShareId);
                }
            }
        }

        Session::flash('success', trans('labels.save_success'));
        return redirect('/rms');
    }
}
