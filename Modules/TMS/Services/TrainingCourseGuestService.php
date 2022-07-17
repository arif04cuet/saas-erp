<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourseGuest;
use Modules\TMS\Repositories\TrainingCourseGuestRepository;

class TrainingCourseGuestService
{
    use CrudTrait;

    /**
     * @var TrainingCourseGuestRepository
     */
    private $trainingCourseGuestRepository;

    public function __construct(TrainingCourseGuestRepository $trainingCourseGuestRepository)
    {
        /** @var TrainingCourseGuestRepository $trainingCourseGuestRepository */
        $this->trainingCourseGuestRepository = $trainingCourseGuestRepository;
        $this->setActionRepository($trainingCourseGuestRepository);
    }

    public function syncGuests(array $data)
    {
        // dd('okkkk');
        return DB::transaction(function () use ($data) {
            $guestResources = collect($data);
            $guests = $guestResources->map(function ($guestInfo) {
                $guestId = isset($guestInfo['guest_id']) ? $guestInfo['guest_id'] : null;
                $guest = TrainingCourseGuest::updateOrCreate(['id' => $guestId], $guestInfo);
                $guest->resource_id = $guestInfo['resource_id'] ?? null;
                $guest->should_be_evaluated = $guestInfo['should_be_evaluated'] ?? null;
                return $guest;
            });
            // dd('okk');
            return $guests;
        });
    }
}
