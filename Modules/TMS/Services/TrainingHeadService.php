<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TrainingHead;
use Illuminate\Http\Response;
use Modules\TMS\Repositories\TrainingHeadRepository;

class TrainingHeadService
{
    use CrudTrait;

    /**
     * @var TrainingsService
     */
    private $trainingService;

    public function __construct(TrainingHeadRepository $trainingHeadRepository, TrainingsService $trainingService)
    {
        $this->setActionRepository($trainingHeadRepository);
        $this->trainingService = $trainingService;
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $trainingHeadData = $this->getTrainingHeadData($data);
            $trainingHead = $this->save($trainingHeadData);

            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Head Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, TrainingHead $trainingHead)
    {
        try {
            DB::beginTransaction();
            $trainingHeadData = $this->getTrainingHeadData($data);
            $trainingHead = $this->update($trainingHead, $trainingHeadData);
 
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Head Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }

    }

    /**
     * @param $data
     */
    public function setTrainingHeadAsOldValues(TrainingHead $trainingHead)
    {
        session(['_old_input.title_english' => $trainingHead->title_english]);
        session(['_old_input.title_bangla' => $trainingHead->title_bangla]);
    }

    public function clearOldSessionValues()
    {
        if (session()->has('_old_input.title_english')) {
            session()->forget('_old_input.title_english');
        }
        if (session()->has('_old_input.title_english')) {
            session()->forget('_old_input.title_bangla');
        }
    }

    public function getTrainings(TrainingHead $trainingHead)
    {
        $trainings = $trainingHead->trainings;
        return $trainings->each(function ($training) {
            $training->modified_status = $this->trainingService->getStatus($training);
            $training->total_registered_trainees = $this->trainingService->getTotelRegistaredTrainee($training);
        });

    }

    public function destroy($id)
    {
        $trainingHead = $this->findOrFail($id);
        DB::transaction(function () use ($trainingHead) {
            $trainingHead->delete();
        });

        return new Response("Training Name has been deleted successfully");
    }

    //------------------------------------------------------------------------------------------
    //                                      Private Function
    //-------------------------------------------------------------------------------------------

    private function getTrainingHeadData(array $data)
    {
        return [
            'title_english' => $data['title_english'],
            'title_bangla' => $data['title_bangla'],
        ];
    }


}

