<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\GetAllRequest;
use App\Http\Requests\ProductCategory\StoreRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;
use App\Services\ProductCategoryService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    use ApiResponse;

    protected $product_category_service;

    /**
     * Inject service
     *
     * @param ProductCategoryService $product_category_service
     * @return void
     */
    public function __construct(ProductCategoryService $product_category_service)
    {
        $this->product_category_service = $product_category_service;
    }


    public function index(Request $request)
    {
        return $this->apiResponse(200, 'Success', $this->product_category_service->getAll());
    }


    public function store(StoreRequest $request)
    {
        $new_category = $this->product_category_service->store($request->all());

        if ($new_category) {
            return $this->apiResponse(201, 'Category created.', $new_category);
        }

        return $this->apiResponse(500, 'Failed to create category');
    }


    public function show($product_category_id)
    {
        return $this->apiResponse(200, 'Success', $this->product_category_service->findById($product_category_id));
    }


    public function update($product_category_id, UpdateRequest $request)
    {
        $update = $this->product_category_service->updateById($product_category_id, $request->all());

        if ($update) {
            return $this->apiResponse(200, 'Category updated.');
        }

        return $this->apiResponse(500, 'Failed to update.');
    }


    public function destroy($product_category_id)
    {
        if ($this->product_category_service->deleteById($product_category_id)) {
            return $this->apiResponse(200, 'Category deleted.');
        }

        return $this->apiResponse(500, 'Failed to delete.');
    }

}
