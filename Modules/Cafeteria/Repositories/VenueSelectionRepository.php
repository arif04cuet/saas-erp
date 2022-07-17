<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\VenueSelection;

class VenueSelectionRepository extends AbstractBaseRepository 
{

    protected $modelName = VenueSelection::class;

    public function fetchDateRangeData($request, $todayDate)
    {
        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $base_query = $this->model->when($start_date, function ($query) use ($start_date, $end_date) {
            return $query->whereBetween('selection_date', [$start_date, $end_date]);
         }, function ($query) use ($todayDate) {
             return $query->where('selection_date', $todayDate);
         });

        $venues = $base_query->get();

        return $venues;
    }
}
