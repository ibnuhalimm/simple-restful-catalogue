<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use App\Traits\ApiResponse;
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
        $limit = 2;
        $skip = ($page - 1) * $limit;

        return $this->jsonResponse(200, 'Success', [
            'product_categories' => $this->repository->getAll($skip, $limit),
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
                'product_category' => $this->repository->storeData($data)
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
                'product_category' => $product_category
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
}