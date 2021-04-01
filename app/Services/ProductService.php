<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Repositories\Product\ProductInterface;

class ProductService
{
    private $repo;

    public function __construct(ProductInterface $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Find by id
     *
     * @param int $id
     * @return Collection
     */
    public function findByIdWithPriceStock(int $id)
    {
        return ProductResource::make($this->repo->findByIdWithPriceStock($id));
    }


    /**
     * Store new data
     *
     * @param array $attributes
     */
    public function storeData(array $attributes)
    {
        return $this->repo->create($attributes);
    }
}