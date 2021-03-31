<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;

class ProductService
{
    use ApiResponse;

    protected $repo;


    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }


    public function findById($id)
    {
        $product = $this->repo->findById($id);

        if (!empty($product)) {
            $category_repo = new ProductCategoryRepository;

            return $this->jsonResponse(200, 'Success', [
                'item' => $product,
                'product_category' => [
                    'item' => $category_repo->findById($product->product_category_id)
                ]
            ]);
        }

        return $this->jsonResponse(404, 'Not found');
    }
}