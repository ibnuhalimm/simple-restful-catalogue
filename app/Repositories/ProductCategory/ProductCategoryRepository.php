<?php

namespace App\Repositories\ProductCategory;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryInterface
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

    /**
     * Find product by id with products
     *
     * @param int $category_id
     * @return Collection
     */
    public function findByIdWithProductsPrice(int $category_id, int $min_price, int $max_price)
    {
        return $this->newQuery()->where('id', $category_id)->with(['products' => function($product) use ($min_price, $max_price) {
            $product->with(['price_stock' => function($price_stock) use ($min_price) {
                $price_stock->where('price', '>=', $min_price);
            }])
            ->whereHas('price_stock', function($price_stok) use ($min_price, $max_price) {
                $price_stok->whereBetween('price', [ $min_price, $max_price ]);
            });
        }])->firstOrFail();
    }
}