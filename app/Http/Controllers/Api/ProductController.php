<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\findWithProductRequest;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    protected $product_category_service;
    protected $product_service;

    /**
     * Construct
     *
     * @param ProductCategoryService $product_category_service
     */
    public function __construct(
        ProductCategoryService $product_category_service,
        ProductService $product_service
        )
    {
        $this->product_category_service = $product_category_service;
        $this->product_service = $product_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param findWithProductRequest $request
     * @param int $category_id
     * @return \Illuminate\Http\Response
     */
    public function index(findWithProductRequest $request, $category_id)
    {
        return $this->apiResponse(200, 'Success', $this->product_category_service->findWithProduct($category_id, $request->all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->apiResponse(200, 'Success', $this->product_service->findByIdWithPriceStock($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
