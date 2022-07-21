<?php

namespace Modules\IMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\IMS\Entities\InventoryRequest;
use Modules\IMS\Http\Requests\InventoryRequestWorkflowRequest;

class CheckInventoryRequestWorkflowRecipient
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $inventoryRequest = $request->inventoryRequest;
        if (!$inventoryRequest->isRecipient()) {
            abort(403);
        }

        return $next($request);
    }
}
