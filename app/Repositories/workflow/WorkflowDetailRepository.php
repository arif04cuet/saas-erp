<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/22/19
 * Time: 12:53 PM
 */

namespace App\Repositories\workflow;


use App\Entities\workflow\WorkflowDetail;
use App\Repositories\AbstractBaseRepository;

class WorkflowDetailRepository extends AbstractBaseRepository
{
    protected $modelName = WorkflowDetail::class;

    public function getWorkflowDetails($userId, $designationIds)
    {
        return WorkflowDetail::with(['workflowMaster', 'workflowConversations' => function ($query) {
            $query->where('status', 'ACTIVE');
        }])
            ->where('status', 'PENDING')
            ->where('creator_id', '!=', $userId)
            ->whereIn('designation_id', $designationIds)
            ->where(function ($query) use ($userId) {
                $query->where('is_group_notification', true)
                    ->whereNull('responder_id')
                    ->orWhere('responder_id', '!=', $userId);
            })
            ->orWhere(function ($query) use ($userId) {
                $query->where('is_group_notification', false)
                    ->Where('responder_id', $userId);
            })->get();

    }

    public function getWorkflowDetailsByFeature($userId, $designationIds, $featureId, $departmentId)
    {
        return WorkflowDetail::with(['workflowMaster', 'ruleDetails', 'workflowConversations' => function ($query) {
            $query->where('status', 'ACTIVE');
        }])
            ->whereHas('workflowMaster', function ($query) use ($featureId) {
                $query->where('feature_id', $featureId);
            })
            ->where('status', 'PENDING')
            ->where('creator_id', '!=', $userId)
            ->whereIn('designation_id', $designationIds)
            ->where('department_id', $departmentId)
            ->where(function ($query) use ($userId) {
                $query->where('is_group_notification', true)
                    ->whereNull('responder_id')
                    ->orWhere('responder_id', '!=', $userId);
            })
            ->orWhere(function ($query) use ($userId) {
                $query->where('is_group_notification', false)
                    ->Where('responder_id', $userId);
            })->get();

    }
}
