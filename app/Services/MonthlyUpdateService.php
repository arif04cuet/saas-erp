<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 1/24/19
 * Time: 4:05 PM
 */

namespace App\Services;


use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Entities\monthlyUpdate\MonthlyUpdateAttachment;
use App\Repositories\MonthlyUpdateRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MonthlyUpdateService
{
    use CrudTrait;
    use FileTrait;

    private $projectResearchUpdateRepository;

    public function __construct(MonthlyUpdateRepository $projectResearchUpdateRepository)
    {
        $this->projectResearchUpdateRepository = $projectResearchUpdateRepository;
        $this->setActionRepository($projectResearchUpdateRepository);
    }

    public function getMonthlyUpdate($updateForId, $type, $monthYear)
    {
        $monthYearAr = explode("-", $monthYear);
        $month = $monthYearAr[0];
        $year = $monthYearAr[1];

        return $this->projectResearchUpdateRepository->getMonthlyUpdate($updateForId, $type, $month, $year);
    }

    public function saveAttachments($monthlyUpdateId, $files)
    {
        $cnt = 0;
        foreach ($files as $file) {
            $storeFile = $this->upload($file, config('filesystems.paths.monthly_update_attachments'));
            $fileExt = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = trim(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            $attachmentData = array(
                'project_research_task_id' => $monthlyUpdateId,
                'file_name' => $fileName,
                'file_ext' => $fileExt,
                'file_path' => $storeFile
            );
            $saveAttachment = $this->projectResearchUpdateRepository->saveAttachments($monthlyUpdateId, $attachmentData);
            if ($saveAttachment) $cnt++;
        }
        return $cnt;
    }

    public function deleteAttachments($attachments)
    {
        foreach ($attachments as $attachment) {
            $del = $this->projectResearchUpdateRepository->deleteAttachment($attachment);
        }
    }

    public function store($monthlyUpdatable, array $data)
    {
        return DB::transaction(function () use ($monthlyUpdatable, $data) {
            $data['date'] = Carbon::createFromFormat('F Y', $data['date']);

            if (array_key_exists('tasks', $data)) {
                $data['tasks'] = implode(', ', $data['tasks']);
            }

            $monthlyUpdate = $monthlyUpdatable->monthlyUpdates()->create($data);

            $this->storeAttachments($monthlyUpdate, $monthlyUpdatable, $data);

            return $monthlyUpdate;
        });
    }

    public function updateEntry(MonthlyUpdate $monthlyUpdate, $monthlyUpdatable, array $data)
    {
        return DB::transaction(function () use ($monthlyUpdate, $monthlyUpdatable, $data) {
            if (array_key_exists('deleted_attachments', $data)) {
                MonthlyUpdateAttachment::destroy($data['deleted_attachments']);
            }

            $this->storeAttachments($monthlyUpdate, $monthlyUpdatable, $data);

            $data['date'] = Carbon::parse($data['date']);

            if (array_key_exists('tasks', $data)) {
                $data['tasks'] = implode(', ', $data['tasks']);
            }

            return $monthlyUpdate->update($data);
        });
    }

    private function storeAttachments($monthlyUpdate, $monthlyUpdatable, $data)
    {
        if (array_key_exists('attachments', $data)) {
            foreach ($data['attachments'] as $file) {
                $filePath = $this->upload($file, $monthlyUpdatable->title . '/' . $data['date']);
                $monthlyUpdate->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_ext' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath
                ]);
            }
        }
    }
}
