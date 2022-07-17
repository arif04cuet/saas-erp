<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        if(Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
