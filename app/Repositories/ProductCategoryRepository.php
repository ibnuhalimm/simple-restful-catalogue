<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoryRepository extends BaseRepository
{
    /**
     * Inject ProductCategory Model
     *
     * @param ProductCategory $product_category
     * @return void
     */
    public function __construct(ProductCategory $product_category)
    {
        parent::__construct($product_category);
    }


    /**
     * Get all
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->newQuery()->get();
    }


    /**
     * Get all by limit offset for pagination or load more
     *
     * @param int $skip
     * @param int $take
     * @param array $criteria
     * @param array $columns
     * @return Collection
     */
    public function getForPagination(int $skip, int $limit, array $criteria = [], array $columns = ['*']): Collection
    {
        return $this->newQuery()->where($criteria)->select($columns)->skip($skip)->take($limit)->get();
    }

    /**
     * Find product by id with products
     * - support pagination for products
     *
     * @param int $category_id
     * @return Collection
     */
    public function findByIdWithProducts(int $category_id)
    {
        return $this->newQuery()->where('id', $category_id)->with(['products' => function($product) {
            $product->with('price_stock');
        }])->firstOrFail();
    }
}