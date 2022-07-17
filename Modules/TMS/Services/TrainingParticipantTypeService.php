<?php
/**
 * Created by PhpStorm.
 * User: mehadi
 * Date: 29/04/20
 * Time: 5:06 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Modules\TMS\Repositories\TrainingParticipantTypeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App;

class TrainingParticipantTypeService
{
    use CrudTrait;
    private $repository;

    /**
     * TrainingParticipantTypeService constructor.
     * @param TrainingParticipantTypeRepository $repository
     */
    public function __construct(
        TrainingParticipantTypeRepository $repository
    )
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store($request)
    {
        $this->repository->store($request->all());
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    public function update($id,$request)
    {
        $this->repository->update($id,$request->all());
    }

    public function destroy($id)
    {
        $traineeType = $this->findOrFail($id);
        DB::transaction(function () use ($traineeType) {
            $traineeType->delete();
        });

        return new Response("Trainee Type has been deleted successfully");
    }
}
