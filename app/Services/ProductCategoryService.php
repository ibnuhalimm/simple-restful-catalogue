<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductCategoryService
{
    use ApiResponse;

    protected $repo;


    public function __construct(ProductCategoryRepository $repository)
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
        return $this->repo->findById($id);
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


    public function findWithProduct(int $id)
    {
        return $this->repo->findByIdWithProducts($id);
    }
}