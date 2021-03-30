<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductCategory\GetAllRequest;
use App\Http\Requests\Api\ProductCategory\StoreRequest;
use App\Http\Requests\Api\ProductCategory\UpdateRequest;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public $product_category_service;

    public function __construct(ProductCategoryService $product_category_service)
    {
        $this->product_category_service = $product_category_service;
    }


    public function index(GetAllRequest $request)
    {
        return $this->product_category_service->getAll($request->page);
    }


    public function store(StoreRequest $request)
    {
        return $this->product_category_service->storeData($request->all());
    }


    public function show($product_category_id)
    {
        return $this->product_category_service->findById($product_category_id);
    }


    public function update($product_category_id, UpdateRequest $request)
    {
        return $this->product_category_service->updateById($request->all(), $product_category_id);
    }


    public function destroy($product_category_id)
    {
        return $this->product_category_service->deleteById($product_category_id);
    }

}
