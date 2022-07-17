<?php

namespace Modules\HRM\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckComplaintWorkflowRecipient
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
        if (!$this->isStateOwner($request)) {
            abort(403);
        }
        return $next($request);
    }

    private function isStateOwner(Request $request)
    {
        if(auth()->user()->id == $request->complaint->complainer_id) {
            return true;
        }

        $lastStateHistory = $request->complaint->stateHistory()->get()->last();
        if (!is_null($lastStateHistory)) {
            return DB::table('state_recipients')
                ->where('state_history_id', $lastStateHistory->id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return false;
    }
}
