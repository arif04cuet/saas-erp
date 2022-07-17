<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/6/19
 * Time: 11:45 AM
 */

namespace Modules\HRM\Services;


use App\Constants\DepartmentShortName;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\ComplaintAttachment;
use Modules\HRM\Entities\ComplaintInvitation;
use Modules\HRM\Repositories\ComplaintInvitationRepository;

class ComplaintInvitationService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var ComplaintInvitationRepository
     */
    private $complaintInvitationRepository;

    /**
     * ComplaintInvitationService constructor.
     * @param ComplaintInvitationRepository $complaintInvitationRepository
     */
    public function __construct(ComplaintInvitationRepository $complaintInvitationRepository)
    {
        $this->complaintInvitationRepository = $complaintInvitationRepository;
        $this->setActionRepository($complaintInvitationRepository);
    }

    public function traverseWorkflow(array $data, ComplaintInvitation $complaintInvitation)
    {
        return DB::transaction(function () use ($data, $complaintInvitation) {
            if ($data['transition'] === 'approve') {
                $complaintInvitation->reviewer_id = $data['reviewer_id'];
            }

            $complaintInvitation->apply($data['transition']);
            return $complaintInvitation->save();
        });
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['creator_id'] = Auth::id();
            $data['status'] = 'ready';
            $complaintInvitation = $this->save($data);

            $this->uploadAttachments($data, $complaintInvitation);

            if ($complaintInvitation->apply('review')) {
                return $complaintInvitation->save();
            } else {
                return false;
            }
        });
    }

    public function dashboardActivities()
    {
        $complaintInvitations = $this->complaintInvitationRepository->findAll()
            ->filter(function ($complaintInvitation) {
                return ($this->isStateRecipient($complaintInvitation) && ($complaintInvitation->status != 'rejected' && $complaintInvitation->status != 'submitted'));
            });

        return $complaintInvitations;
    }

    public function getVisibleComplaintInvitations()
    {
        $complaintInvitations = $this->complaintInvitationRepository->findAll()
            ->filter(function($complaintInvitation) {

                if(get_user_department()->department_code == DepartmentShortName::HrmSection) {
                    return true;
                }

                if(!is_null(auth()->user()->employee)) {
                    if($complaintInvitation->complainer->id == auth()->user()->employee->id) {
                        return true;
                    }
                    if($complaintInvitation->creator->id == auth()->user()->employee->id) {
                        return true;
                    }
                }

                if($this->isStateRecipient($complaintInvitation)) {
                    return true;
                }

            });

        return $complaintInvitations;
    }

    private function isStateRecipient(ComplaintInvitation $complaintInvitation)
    {
        $lastStateHistory = $complaintInvitation->stateHistory()->get()->last();

        if (!is_null($lastStateHistory)) {
            return DB::table('state_recipients')
                ->where('state_history_id', $lastStateHistory->id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return false;
    }

    /**
     * @param $data
     * @param ComplaintInvitation $complaintInvitation
     */
    private function uploadAttachments(array $data, ComplaintInvitation $complaintInvitation): void
    {
        if (!empty($data['attachments'])) {
            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = $this->upload($file, "complaint-invitation/{$complaintInvitation->id}");

                $complaintAttachment = new ComplaintAttachment([
                    'file_name' => $fileName,
                    'file_path' => $filePath
                ]);

                $complaintInvitation->attachments()->save($complaintAttachment);
            }
        }
    }
}