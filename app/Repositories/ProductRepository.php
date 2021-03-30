<?php

namespace App\Repositories;

use App\Contracts\BasicApiOperations;
use App\Models\Product;

class ProductRepository implements BasicApiOperations
{
    /**
     * Get all `products` data
     *
     * @param int $skip
     * @param int $limit
     * @return Illuminate\Support\Collection
     */
    public function getAll(int $skip, int $limit)
    {
        return Product::take($limit)->skip($skip)->get();
    }

    /**
     * Store data into `products` table
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function storeData(array $data)
    {
        return Product::create($data);
    }

    /**
     * Get single `products` data by id
     *
     * @param int $id
     * @return \App\Models\Product|null
     */
    public function findById($id)
    {
        return Product::where('id', $id)->first();
    }

    /**
     * Update data in `products` table
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateById(array $data, $id)
    {
        Product::where('id', $id)->update($data);

        return $data;
    }

    /**
     * Delete data from `products` table
     *
     * @param int $product_id
     * @param App\Models\Product $model
     * @return int
     */
    public function deleteById($id)
    {
        Product::destroy($id);

        return $id;
    }

    /**
     * Count the records of the `products` table
     *
     * @return int
     */
    public function totalRecords()
    {
        return Product::count();
    }

    /**
     * Get product by product_category
     *
     * @param int $product_category_id
     * @param int $skip
     * @param int $limit
     */
    public function getByCategory($product_category_id, $skip, $limit)
    {
        return Product::where('product_category_id', $product_category_id)->skip($skip)->take($limit)->get();
    }

}