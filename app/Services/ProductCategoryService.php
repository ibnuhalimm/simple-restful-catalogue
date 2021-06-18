<?php

namespace App\Services;

use App\Http\Resources\ProductCategoryResource;
use App\Repositories\ProductCategory\ProductCategoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductCategoryService
{
    private $repo;

    public function __construct(ProductCategoryInterface $repository)
    {
        $this->repo = $repository;
    }


    public function getAll()
    {
        return $this->repo->getAll();
    }


    public function getForPagination(int $page)
    {
        $limit = 10;
        $skip = ($page - 1) * $limit;

        return [
            'items' => $this->repo->getForPagination($skip, $limit),
            'total_records' => $this->repo->countRecords()
        ];
    }


    public function store(array $attributes)
    {
        try {
            $data = [
                'name' => Str::of($attributes['name'])->trim()->lower()
            ];

            return $this->repo->create($data);

        } catch (\Throwable $th) {
            report($th);

            return false;
        }

    }


    public function findById(int $id)
    {
        try {
            return $this->repo->findById($id);

        } catch (ModelNotFoundException $th) {
            report($th);

            return;
        }
    }


    public function updateById(int $id, array $attributes)
    {
        try {
            if ($id !== $attributes['id']) {
                return false;
            }

            $data = [
                'name' => $attributes['name']
            ];

            $category = $this->repo->findById($id);
            $category->update($data);

            return true;

        } catch (\Throwable $th) {
            report($th);

            return false;
        }
    }


    public function deleteById($id)
    {
        try {
            $this->repo->findById($id)->delete();

            return true;

        } catch (\Throwable $th) {
            report($th);

            return false;
        }
    }


    public function findWithProduct(int $id, $params = [])
    {
        if (empty($params)) {
            return ProductCategoryResource::make($this->repo->findByIdWithProducts($id));
        }

        $min_price = isset($params['min_price']) ? $params['min_price'] : 0;
        $max_price = isset($params['max_price']) ? $params['max_price'] : 10000;

        return ProductCategoryResource::make($this->repo->findByIdWithProductsPrice($id, $min_price, $max_price));
    }
}