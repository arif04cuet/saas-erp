<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\NewsLetterRequest;
use App\Services\NewsLetterService;

class NewsletterController extends Controller
{
    private $newsLetterService;

    public function __construct( NewsLetterService $newsLetterService)
    {
        $this->newsLetterService = $newsLetterService;
    }

    public function index()
    {
        $venues = $this->newsLetterService->index();
        // return view('tms::venue.index',compact( 'venues' ));
    }
    
    public function create()
    {
        return view('tms::venue.create');
    }

    public function store(NewsLetterRequest $request)
    {
        $this->newsLetterService->store($request);
        Session::flash('success', trans('landing.your_registration_is_completed'));
        return redirect('/');
    }

    public function show($id)
    {
        $venue = $this->newsLetterService->find($id);
        return view('tms::venue.show',compact('venue'));
    }

    public function edit($id)
    {
        $venue = $this->newsLetterService->find($id);
        return view('tms::venue.edit',compact('venue'));
    }

    public function update(NewsLetterRequest $request, $id)
    {
        $this->newsLetterService->update($id, $request);
        Session::flash('success', trans('labels.update_success'));
        return redirect('/tms/venue');
    }
}