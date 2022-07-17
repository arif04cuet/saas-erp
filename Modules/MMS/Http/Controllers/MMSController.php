<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MMSController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('mms::index');
    }
}
