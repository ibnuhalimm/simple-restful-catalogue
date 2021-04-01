<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
     * Inject Product Model
     *
     * @param Product $product
     * @return void
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * Count total records of products table by product_category
     *
     * @param int $product_category_id
     * @return int
     */
    public function countByCategory(int $product_category_id)
    {
        return $this->newQuery()
                    ->where('product_category_id', $product_category_id)
                    ->count();
    }


    /**
     * Find by id with price_stock
     *
     * @param int $id
     * @return Collection
     */
    public function findByIdWithPriceStock(int $id)
    {
        return $this->findById($id, ['*'], ['price_stock']);
    }

}