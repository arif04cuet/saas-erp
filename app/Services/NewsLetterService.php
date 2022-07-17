<?php
/**
 * Created by VS Code.
 * User: Araf
 * Date: 10/2/2022
 * Time: 5:06 PM
 */
namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\NewsLetterRepository;
use Illuminate\Support\Facades\DB;
use App;

class NewsLetterService
{
    use CrudTrait;

    private $repository;

    /**
     * TrainingVenueService constructor.
     * @param NewsLetterRepository $repository
     */
    public function __construct(
        NewsLetterRepository $repository,
    ) {
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

    public function update($id, $request)
    {
        $this->repository->update($id, $request->all());
    }
}
