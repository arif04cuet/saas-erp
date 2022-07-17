<?php

namespace Modules\TMS\Services;

use Carbon\Carbon;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCategory;

class TmsDashboardCalenderService
{

    /**
     * Get all the events
     * @return array
     */
    public function getEvents(): array
    {
        $resources = [];
        $trainings = Training::with('trainingSponsors.organization')
            ->whereNotNUll('start_date')
            ->whereNotNUll('end_date')
            ->get();
        foreach ($trainings as $training) {

            $startDate = $training->start_date;
            $endDate = $training->end_date;
            if (is_null($endDate)) {
                dd($training);
            }
            if ($startDate == $endDate) {
                $startDate = Carbon::parse($training->start_date)->format('Y-m-d');
                $endDate = Carbon::parse($training->end_date)->addDay(1)->format('Y-m-d');
            }
            if ($training->start_date) {
                $resources [] = (object)[
                    'title' => $training->title ?? trans('labels.not_found'),
                    'resourceId' => $training->id ?? null,
                    'level' => $training->level ?? null,
                    'no_of_trainee' => $training->no_of_trainee ?? null,
                    'sponsor' => $training->trainingSponsors->first()->organization->name ?? null,
                    'level' => $training->level ?? trans('labels.not_found'),
                    'start' => $startDate ?? null,
                    'end' => $endDate ?? null,
                ];
            }
        }
        return $resources;

    }

    public function getResources(): array
    {
        $resources = [];
        $trainings = Training::with('category')
            ->whereNotNUll('start_date')
            ->whereNotNUll('end_date')
            ->get();
        $id = 1;
        foreach ($trainings as $training) {
            $title = $training->category
                ? $training->category->getName()
                : trans('labels.not_found');
            $resources [] = (object)[
                'id' => $training->id,
                'category_title' => $title,
                'course_title' => $training->title ?? trans('labels.not_found')
            ];
        }
        return $resources;
    }

    public function getResourceColumns()
    {
        return [
            (object)[
                // 'group' => true,
                'labelText' => trans('labels.category'),
                'field' => 'category_title'
            ],
            // (object)[
            //     'labelText' => trans('tms::training.title'),
            //     'field' => 'course_title'
            // ]
        ];
    }
}

