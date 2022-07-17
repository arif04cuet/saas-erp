<?php

/**
 * Created by vs code.
 * User: araf
 * Date: 10/2/2022
 * Time: 5:06 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Repositories\DoptorRepository;
use Symfony\Component\HttpFoundation\Response;
use Modules\TMS\Repositories\TrainingVenueRepository;

class TrainingVenueService
{
    use CrudTrait;

    private $repository;
    private $trainingCafeteriaService;
    private $doptorRepository;

    /**
     * TrainingVenueService constructor.
     * @param TrainingVenueRepository $repository
     * @param TrainingCafeteriaService $trainingCafeteriaService
     */
    public function __construct(
        TrainingVenueRepository $repository,
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

        return new Response("Venue has been deleted successfully");
    }

    public function venuesForCalendar()
    {
        $venues = $this->repository->findAll()
            ->map(function ($venue) {
                return [
                    'id' => $venue->id,
                    'title' => !App::isLocale('bn') ? $venue->title : $venue->title_bn
                ];
            });

        //         $cafeterias = $this->trainingCafeteriaService->findAll()
        //             ->map(function ($cafeteria) {

        //                 return [
        //                     'id' => 'cafeteria_recurring_resource_' . $cafeteria->id,
        //                     'title' => trans("tms::module.$cafeteria->name"),
        //                 ];
        // //                'tms::module.list'
        //             });

        //         $venues = $venues->merge($cafeterias);

        return $venues;
    }

    public function venuesDropDownForRecurringSessions()
    {
        $data = collect();

        $this->repository
            ->findAll()
            ->each(function ($venue) use (&$data) {
                $data->push((object)[
                    'title' => App::isLocale('bn') ? $venue->title_bn : $venue->title,
                    'id' => 'venue_id_' . $venue->id,
                    'type' => trans('tms::venue.venue'),
                ]);
            });

        // $this->trainingCafeteriaService
        //     ->findAll()
        //     ->each(function ($cafeteria) use ($data) {
        //         $data->push((object)[
        //             'title' => $cafeteria->name,
        //             'id' => 'cafeteria_id_' . $cafeteria->id,
        //             'type' => trans('tms::training_cafeteria.title'),
        //         ]);
        //     });
        return $data;
    }

    public function getTrainingVenuesForDropdown()
    {
        $venue_title = !App::isLocale('bn') ? 'title' : 'title_bn';
        return $this->findAll()->pluck($venue_title, 'id');
    }
}
