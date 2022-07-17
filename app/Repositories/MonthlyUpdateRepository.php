<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 1/24/19
 * Time: 4:14 PM
 */

namespace App\Repositories;


use App\Entities\monthlyUpdate\MonthlyUpdateAttachment;
use App\Entities\monthlyUpdate\MonthlyUpdate;

class MonthlyUpdateRepository extends AbstractBaseRepository
{
    protected $modelName = MonthlyUpdate::class;

    public function getMonthlyUpdate($updateForId, $type, $month, $year)
    {
        return $this->model->where('update_for_id', $updateForId)
            ->where('type', $type)
            ->where('month', $month)
            ->where('year', $year)
            ->first();
    }

    public function saveAttachments($monthlyUpdateId, $data)
    {
        $monthlyUpdate = $this->findOne($monthlyUpdateId);
        $save = $monthlyUpdate->attachments()->create($data);

        return $save->getAttribute('id');
    }

    public function deleteAttachment($attachmentId)
    {
        return MonthlyUpdateAttachment::where('id', $attachmentId)->delete();
    }
}
