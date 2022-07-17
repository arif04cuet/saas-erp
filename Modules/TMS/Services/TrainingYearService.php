<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TrainingYear;
use Modules\TMS\Repositories\TrainingYearRepository;

class TrainingYearService
{
    use CrudTrait;

    /**
     * @var trainingYearRepository
     */
    private $trainingYearRepository;

    public function __construct(TrainingYearRepository $trainingYearRepository)
    {
        $this->setActionRepository($trainingYearRepository);
        $this->trainingYearRepository = $trainingYearRepository;
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $trainingYearData = $this->getTrainingYearData($data);
            $trainingYear = $this->save($trainingYearData);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Year Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }
    }

    public function update($id, $request)
    {
        $this->trainingYearRepository->update($id, $request->all());
    }

    // public function updateData(array $data, TrainingYear $trainingYear)
    // {
    //     try {
    //         DB::beginTransaction();
    //         // $trainingYearData = $this->getTrainingYearData($data);
    //         $trainingYear = $this->update($trainingYear, $data);
    //         DB::commit();
    //         return true;
    //     } catch (Exception $exception) {
    //         DB::rollBack();
    //         Log::error('Training Year Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
    //         return false;
    //     }

    // }

    /**
     * @param $data
     */
    public function setTrainingHeadAsOldValues(TrainingYear $trainingYear)
    {
        session(['_old_input.start_date' => $trainingYear->start_date]);
        session(['_old_input.end_date' => $trainingYear->end_date]);
    }

    public function clearOldSessionValues()
    {
        if (session()->has('_old_input.start_date')) {
            session()->forget('_old_input.start_date');
        }
        if (session()->has('_old_input.start_date')) {
            session()->forget('_old_input.end_date');
        }
    }

    public function find($id)
    {
        return $this->trainingYearRepository->find($id);
    }

    public function destroy($id)
    {
        $trainingYear = $this->findOrFail($id);
        DB::transaction(function () use ($trainingYear) {
            $trainingYear->delete();
        });

        return new Response("Training Year has been deleted successfully");
    }

    //------------------------------------------------------------------------------------------
    //                                      Private Function
    //-------------------------------------------------------------------------------------------

    private function getTrainingYearData(array $data)
    {
        return [
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ];
    }


}

