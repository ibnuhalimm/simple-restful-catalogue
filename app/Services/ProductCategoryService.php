<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductCategoryService
{
    use ApiResponse;

    protected $repository;


    public function __construct(ProductCategoryRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getAll(int $page)
    {
        $limit = 10;
        $skip = ($page - 1) * $limit;

        return $this->jsonResponse(200, 'Success', [
            'items' => $this->repository->getAll($skip, $limit),
            'total_records' => $this->repository->totalRecords()
        ]);
    }


    public function storeData(array $attributes)
    {
        try {
            $data = [
                'name' => Str::of($attributes['name'])->trim()->lower()
            ];

            return $this->jsonResponse(200, 'Success', [
                'item' => $this->repository->storeData($data)
            ]);

        } catch (\Throwable $th) {
            report($th);

            return $this->jsonResponse(500, 'Something went wrong', null);
        }

    }


    public function findById(int $id)
    {
        $product_category = $this->repository->findById($id);

        if (!empty($product_category)) {
            return $this->jsonResponse(200, 'Success', [
                'item' => $product_category
            ]);
        }

        return $this->jsonResponse(404, 'Not Found', null);
    }


    public function updateById(array $data, int $id)
    {
        try {
            if ($data['id'] !== $id) {
                return $this->jsonErrorResponse(422, 'The given data was invalid', [
                    'id' => 'The id field doesn\'t match'
                ]);
            }

            $this->repository->updateById($data, $id);

            return $this->jsonResponse(200, 'Success', null);

        } catch (\Throwable $th) {
            report($th);

            return $this->jsonResponse(500, 'Something went wrong');

        }
    }


    public function deleteById(int $id)
    {
        try {
            $this->repository->deleteById($id);

            return $this->jsonResponse(200, 'Success', null);

        } catch (\Throwable $th) {
            report($th);

            return $this->jsonResponse(500, 'Something went wrong');

        }
    }


    public function findWithProduct(int $id, int $page)
    {
        $product_category = $this->repository->findById($id);

        if (!empty($product_category)) {
            $limit = 10;
            $skip = ($page - 1) * $limit;

            $product_repo = new ProductRepository;

            return $this->jsonResponse(200, 'Success', [
                'item' => $product_category,
                'products' => [
                    'items' => $product_repo->getByCategory($id, $skip, $limit),
                    'total_records' => $product_repo->totalRecords()
                ]
            ]);
        }

        return $this->jsonResponse(404, 'Not found', null);
    }
}