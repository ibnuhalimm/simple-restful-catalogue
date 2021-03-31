<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Traits\ApiResponse;

class ProductService
{
    /**
     * @var mixed
     */
    protected $repo;

    /**
     * Inject ProductRepository
     *
     * @param ProductRepository $repo
     * @return void
     */
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Find by id
     *
     * @param int $id
     * @return Collection
     */
    public function findByIdWithPriceStock(int $id)
    {
        return $this->repo->findByIdWithPriceStock($id);
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