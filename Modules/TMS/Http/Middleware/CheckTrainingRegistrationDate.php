<?php

namespace Modules\TMS\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TMS\Entities\Training;

class CheckTrainingRegistrationDate
{
    private $request;

    private $training;

    private $authorized;

    private $redirectUrl;

    private $escapeRoutes = ['trainee.index'];

    private $route;

    private const DEFAULT_REDIRECT_URL = 'training-registration.index';

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $authorized
     * @param string $training
     * @return RedirectResponse|mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        string $authorized,
        string $training
    )
    {
        $this->redirectUrl = null;

        $this->request = $request;

        $this->setRouteName();

        $escapeRoute = in_array($this->route, $this->escapeRoutes);

        $this->training = $this->request->route()->hasParameter($training)
            ? $this->setTraining($this->request->route()->parameter($training))
            : null;

        $this->setAuthorized($authorized);

        $this->validate($this->authorized);

        return (is_null($this->redirectUrl) || ($escapeRoute && is_null($this->training))) ? $next($request) : redirect()->to($this->redirectUrl);
    }

    private function validate($authorized)
    {
        if(is_null($this->training)) {
            $this->redirectTo();
        } else {
            if($authorized) {
                $this->validateWithAuth();
            }else {
                $this->validateWithoutAuth();
            }
        }
    }

    private function validateWithAuth()
    {
        $isDeadlineSet = $this->checkDeadline();

        if (!$isDeadlineSet) {
            $this->redirectUrl = route('training.durationDeadline.edit', ['training' => $this->training]);
        }
    }

    private function validateWithoutAuth()
    {
        $isDeadlineSet = $this->checkDeadline();

        if (!$isDeadlineSet) {
            $this->redirectUrl = route(self::DEFAULT_REDIRECT_URL);
        }

        $isTrainingCompleted = $this->isTrainingCompleted();

        if ($isTrainingCompleted) {
            $this->redirectUrl = route(self::DEFAULT_REDIRECT_URL);
        }
    }

    private function checkDeadline()
    {
        return is_null(optional($this->training)->registration_deadline) ? false : true;
    }

    private function isTrainingCompleted()
    {
        $endDate = optional($this->training)->end_date;
        $endDate = !is_null($endDate) ? Carbon::parse($endDate) : Carbon::yesterday('Asia/Dhaka');
        $today = Carbon::today('Asia/Dhaka');

        return $endDate->lessThan($today);

    }

    private function setAuthorized($authorized)
    {
        $this->authorized = $authorized == 'true' ? true : false;
    }

    private function redirectTo()
    {
        if(!in_array($this->route, $this->escapeRoutes)) {

            $this->redirectUrl = $this->authorized ? route('training.index') : route(self::DEFAULT_REDIRECT_URL);
        }

    }

    private function setRouteName()
    {
        $this->route = $this->request->route()->getName();
    }

    private function setTraining($training)
    {
        if(!$training instanceof Training) {
            $training = Training::findOrFail($training);
        }

        return $training;
    }
}
