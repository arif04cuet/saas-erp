<?php

namespace Modules\HRM\Http\Middleware;

use App\Constants\DepartmentShortName;
use App\Constants\SectionName;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckCompletedAppraisalRecipient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$this->authorizedUser($request)) {
            abort(403);
        }

        return $next($request);
    }

    private function authorizedUser($request)
    {
        if(get_user_section()->name == SectionName::Establishment) {
            return true;
        }

        if($request->appraisal->initiator->user) {
            if($request->appraisal->initiator->user->id == auth()->user()->id) {
                return true;
            }
        }

        $lastStateHistory = $request->appraisal->stateHistory()->get()->last();

        if(!is_null($lastStateHistory)) {
            return DB::table('state_recipients')
                ->where('state_history_id', $lastStateHistory->id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return false;

    }
}
