<?php

namespace Modules\HRM\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckEmployeeLeaveWorkflowRecipient
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
        $leaveRequest = $request->leaveRequest;

        if (!$leaveRequest->isRecipient()) {
            abort(403);
        }

        return $next($request);
    }
}
