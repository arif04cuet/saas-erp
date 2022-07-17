<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TrainingType;
use Modules\TMS\Repositories\TrainingTypeRepository;

class TrainingTypeService
{
    use CrudTrait;

    /**
     * @var TrainingsService
     */
    private $trainingType;
    private $trainingTypeRepository;

    public function __construct(TrainingTypeRepository $trainingTypeRepository, TrainingType $trainingType)
    {
        $this->setActionRepository($trainingTypeRepository);
        $this->trainingType = $trainingType;
        $this->trainingTypeRepository = $trainingTypeRepository;
    }

    public function pluck()
    {
        return $this->trainingTypeRepository->pluck();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $trainingTypeData = $this->getTrainingTypeData($data);
            $trainingType = $this->save($trainingTypeData);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Head Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, TrainingType $trainingType)
    {
        try {
            DB::beginTransaction();
            $trainingTypeData = $this->getTrainingTypeData($data);
            $trainingType = $this->update($trainingType, $trainingTypeData);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Type Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }

    }

    /**
     * @param $data
     */
    public function setTrainingHeadAsOldValues(TrainingType $trainingType)
    {
        session(['_old_input.name_english' => $trainingType->name_english]);
        session(['_old_input.name_bangla' => $trainingType->name_bangla]);
    }

    public function clearOldSessionValues()
    {
        if (session()->has('_old_input.name_english')) {
            session()->forget('_old_input.name_english');
        }
        if (session()->has('_old_input.name_english')) {
            session()->forget('_old_input.name_bangla');
        }
    }

    public function getTrainings(TrainingType $trainingType)
    {
        $trainings = $trainingType->trainings;
        return $trainings->each(function ($training) {
            $training->modified_status = $this->trainingService->getStatus($training);
            $training->total_registered_trainees = $this->trainingService->getTotelRegistaredTrainee($training);
        });

    }

    public function destroy($id)
    {
        $trainingType = $this->findOrFail($id);
        DB::transaction(function () use ($trainingType) {
            $trainingType->delete();
        });

        return new Response("Training Type has been deleted successfully");
    }

    public function getTrainingTypesForDropdown()
    {
        $training_title = !App::isLocale('bn') ? 'name_english' : 'name_bangla';
        return $this->findAll()->pluck($training_title, 'id');
    }

    //------------------------------------------------------------------------------------------
    //                                      Private Function
    //-------------------------------------------------------------------------------------------

    private function getTrainingTypeData(array $data)
    {
        if(!isset($data['parent_id'])){
            $parent_id = 0;
        }else{
            $parent_id = $data['parent_id'];
        }
        
        return [
            'name_english' => $data['name_english'],
            'name_bangla' => $data['name_bangla'],
            'parent_id' => $parent_id,
        ];
    }


}

