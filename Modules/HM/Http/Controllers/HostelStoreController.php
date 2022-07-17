<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class HostelStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $items = collect([
            (object) [
                'name' => 'Item 1',
                'quantity' => 10,
            ],
            (object) [
                'name' => 'Item 2',
                'quantity' => 20,
            ],
            (object) [
                'name' => 'Item 3',
                'quantity' => 30,
            ],
            (object) [
                'name' => 'Item 4',
                'quantity' => 40,
            ],
            (object) [
                'name' => 'Item 5',
                'quantity' => 50,
            ],
        ]);

        return view('hm::store.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('hm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('hm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
