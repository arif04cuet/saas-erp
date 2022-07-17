<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Services\TrainingCourseService;

class TrainingCafeteriaCalendarController extends Controller
{
    private $courseService;

    /**
     * TrainingCafeteriaCalendarController constructor.
     * @param TrainingCourseService $courseService
     */
    public function __construct(TrainingCourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function show()
    {
        $cafeterias = $this->getCafeterias();
        $courses = $this->getCourses();

        $events = $this->getEvents($cafeterias, $courses);

        return view('tms::training.cafeteria.calendar.show', compact('cafeterias',
                'courses',
                'events'
            )
        );
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRandomTimes(): \Illuminate\Support\Collection
    {
        $randomTimes = collect();
        for ($i = 0; $i < 9; $i++) {
            $randomTime = Carbon::createFromTime(mt_rand(8, 22));
            $randomTimes->push($randomTime);
        }
        return $randomTimes;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getCafeterias(): \Illuminate\Support\Collection
    {
        $cafeterias = collect();
        for ($i = 1; $i <= 3; $i++) {
            $cafeterias->push("Cafeteria $i");
        }
        return $cafeterias;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getCourses(): \Illuminate\Support\Collection
    {
        $courses = collect();
        for ($i = 1; $i <= 3; $i++) {
            $courses->push("Course $i");
        }
        return $courses;
    }

    /**
     * @param $cafeterias
     * @param $courses
     * @return mixed
     */
    private function getEvents($cafeterias, $courses)
    {
        $randomTimes = $this->getRandomTimes();

        $events = $randomTimes->map(function ($randomTime) use ($cafeterias, $courses) {
            $randomCafeteria = $cafeterias[mt_rand(0, 2)];
            $randomCourse = $courses[mt_rand(0, 2)];

            return [
                'title' => "$randomCourse - $randomCafeteria",
                'start' => $randomTime->format('G:i')
            ];
        });
        return $events;
    }
}
