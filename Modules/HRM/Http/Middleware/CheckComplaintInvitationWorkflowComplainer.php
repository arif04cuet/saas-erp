<?php

namespace Modules\HRM\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\ComplaintInvitation;

class CheckComplaintInvitationWorkflowComplainer
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
        if (!is_null($request->complaintInvitation)){
            if (!$this->isStateOwner($request)) {
                abort(403);
            }
        }

        return $next($request);
    }


    private function isStateOwner(Request $request)
    {
        $lastStateHistory = $request->complaintInvitation->stateHistory()->get()->last();

        if (!is_null($lastStateHistory) && $lastStateHistory->statable_type == ComplaintInvitation::class) {
            return DB::table('state_recipients')
                ->where('state_history_id', $lastStateHistory->id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return false;
    }
}
