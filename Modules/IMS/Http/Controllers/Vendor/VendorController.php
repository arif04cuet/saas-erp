<?php

namespace Modules\IMS\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\Vendor;
use Modules\IMS\Services\VendorService;

class VendorController extends Controller
{
    /**
     * @var VendorService
     */
    private $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $vendors = $this->vendorService->findAll(null, null, ['column'=>'created_at','direction'=>'desc']);
        return view('ims::vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ims::vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->vendorService->save($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('vendor.index');
    }

    /**
     * Show the specified resource.
     * @param Vendor $vendor
     * @return Response
     */
    public function show(Vendor $vendor)
    {
        return view('ims::vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Vendor $vendor
     * @return Response
     */
    public function edit(Vendor $vendor)
    {
        return view('ims::vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Vendor $vendor
     * @return Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        if ($this->vendorService->update($vendor, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('vendor.index');
    }
}
