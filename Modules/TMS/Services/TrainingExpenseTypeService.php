<?php

/**
 * Created by VS Code.
 * User: Araf
 * Date: 10/2/2022
 * Time: 5:06 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Repositories\DoptorRepository;
use Symfony\Component\HttpFoundation\Response;
use Modules\TMS\Repositories\TrainingExpenseTypeRepository;

class TrainingExpenseTypeService
{
    use CrudTrait;

    private $repository;
    private $trainingCafeteriaService;
    private $doptorRepository;

    /**
     * TrainingExpenseTypeService constructor.
     * @param TrainingExpenseTypeRepository $repository
     * @param TrainingCafeteriaService $trainingCafeteriaService
     */
    public function __construct(
        TrainingExpenseTypeRepository $repository,
        TrainingCafeteriaService $trainingCafeteriaService,
        DoptorRepository $doptorRepository
    ) {
        $this->repository = $repository;
        $this->trainingCafeteriaService = $trainingCafeteriaService;
        $this->doptorRepository = $doptorRepository;
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

    public function update($id, $request)
    {
        $this->repository->update($id, $request->all());
    }

    public function pluck()
    {
        return $this->doptorRepository->pluck();
    }

    public function destroy($id)
    {
        $venue = $this->findOrFail($id);
        DB::transaction(function () use ($venue) {
            $venue->delete();
        });

        return new Response("Expense Type has been deleted successfully");
    }


    public function getTrainingVenuesForDropdown()
    {
        $venue_title = !App::isLocale('bn') ? 'title' : 'title_bn';
        return $this->findAll()->pluck($venue_title, 'id');
    }
}
