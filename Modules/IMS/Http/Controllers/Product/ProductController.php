<?php

namespace Modules\IMS\Http\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\Product;
use Modules\IMS\Http\Requests\CreateProductRequest;
use Modules\IMS\Http\Requests\UpdateProductRequest;
use Modules\IMS\Services\ProductService;

class ProductController extends Controller
{

    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        /** @var ProductService $productService */
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Product $product)
    {
        $products = $this->productService->getAllProducts();
        return view('ims::product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ims::product.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $this->productService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory.product.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Product $product)
    {
        return view('ims::product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Product $product)
    {
        return view('ims::product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($product, $request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory.product.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
