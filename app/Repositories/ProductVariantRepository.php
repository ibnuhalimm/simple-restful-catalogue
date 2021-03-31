<?php

namespace App\Repositories;

use App\Contracts\BasicApiOperations;
use App\Models\ProductVariant;

class ProductVariantRepository implements BasicApiOperations
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
        return ProductVariant::take($limit)->skip($skip)->get();
    }

    /**
     * Store data into `products` table
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function storeData(array $data)
    {
        return ProductVariant::create($data);
    }

    /**
     * Get single `products` data by id
     *
     * @param int $id
     * @return \App\Models\Product|null
     */
    public function findById($id)
    {
        return ProductVariant::where('id', $id)->first();
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
        ProductVariant::where('id', $id)->update($data);

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
        ProductVariant::destroy($id);

        return $id;
    }

    /**
     * Count the records of the `products` table
     *
     * @return int
     */
    public function totalRecords()
    {
        return ProductVariant::count();
    }

    /**
     * Get product by product_id
     *
     * @param int $product_id
     * @return mixed|array
     */
    public function getByProduct($product_id)
    {
        return ProductVariant::where('product_id', $product_id)->get();
    }

    /**
     * Get product by product_id
     *
     * @param int $product_id
     * @return mixed|object
     */
    public function findByProduct($product_id)
    {
        return ProductVariant::where('product_id', $product_id)->first();
    }

}