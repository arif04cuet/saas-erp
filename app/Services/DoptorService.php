<?php

/**
 * Created by VS Code.
 * User: Araf
 * Date: 10/06/2022
 * Time: 5:06 PM
 */

namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\DoptorRepository;
use Illuminate\Support\Facades\DB;
use App;

class DoptorService
{
    use CrudTrait;

    private $doptorRepository;

    /**
     * ModuleService constructor.
     * @param DoptorRepository $repository
     */
    public function __construct(
        DoptorRepository $doptorRepository,
    ) {
        $this->doptorRepository = $doptorRepository;
        $this->setActionRepository($doptorRepository);
    }

    public function find($id)
    {
        return $this->doptorRepository->find($id);
    }

    public function destroy($id)
    {
        $module = $this->findOrFail($id);
        DB::transaction(function () use ($module) {
            $module->delete();
        });

        return new Response("User has been deleted successfully");
    }

    public function updateDoptor($id, array $data)
    {
        $doptor = $this->findOrFail($id);
        DB::transaction(function () use ($doptor, $data) {
            $this->update($doptor, $data);
            if (isset($data['module_name'])) {
                $doptor->modules()->sync($data['module_name']);
            }
        });
        return new Response("Doptor has been updated successfully");
    }

    public function pluck()
    {
        return $this->doptorRepository->pluck();
    }
}
