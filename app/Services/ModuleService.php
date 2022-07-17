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
use App\Repositories\ModuleRepository;
use Illuminate\Support\Facades\DB;
use App;

class ModuleService
{
    use CrudTrait;

    private $moduleRepository;

    /**
     * ModuleService constructor.
     * @param ModuleRepository $repository
     */
    public function __construct(
        ModuleRepository $moduleRepository,
    ) {
        $this->moduleRepository = $moduleRepository;
        $this->setActionRepository($moduleRepository);
    }

    public function index()
    {
        return $this->moduleRepository->all();
    }

    public function store($request)
    {
        $this->moduleRepository->store($request->all());
    }

    public function find($id)
    {
        return $this->moduleRepository->find($id);
    }

    public function update($id, $request)
    {
        $this->moduleRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        $module = $this->findOrFail($id);
        DB::transaction(function () use ($module) {
            $module->delete();
        });

        return new Response("User has been deleted successfully");
    }

    public function pluck()
    {
        return $this->moduleRepository->pluck();
    }
}
