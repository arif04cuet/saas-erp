<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CheckExpiryDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $model
     * @param String $property
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next, string $model, string $property)
    {
        try {
            $date = $this->getDateToCheck($request, $model, $property);

            if ($date->greaterThanOrEqualTo(Carbon::today())) {
                return $next($request);
            } else {
                abort(500, trans('error.expired', ['arg' => $model]));
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param $request
     * @param $entity
     * @param $property
     * @return Carbon|mixed
     * @throws \Exception
     */
    private function getDateToCheck($request, $entity, $property)
    {
        if (!is_subclass_of($request->$entity, Model::class)) {
            throw new \Exception('Model ' . ucfirst($entity) . ' not found!');
        }

        if (is_null($date = Arr::get($request->$entity, "$property"))) {
            throw new \Exception("Invalid property: $property");
        }
        $date = Carbon::parse($date);
        return $date;
    }
}
