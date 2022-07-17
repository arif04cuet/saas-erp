<?php

namespace Modules\HRM\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLeaveRequestEditPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $leaveRequest = $request->leaveRequest;

        if (($leaveRequest->requester_id != Auth::id())
            || in_array($leaveRequest->status, ['approved', 'rejected'])) {
            abort(403);
        }
        return $next($request);
    }
}
