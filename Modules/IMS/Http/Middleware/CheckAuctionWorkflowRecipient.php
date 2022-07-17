<?php

namespace Modules\IMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuctionWorkflowRecipient
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
        $auctionRequest = $request->auction;
        if(!$auctionRequest->isRecipient()) {
            abort(403);
        }

        return $next($request);
    }
}
