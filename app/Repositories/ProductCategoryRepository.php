<?php

namespace App\Repositories;

use App\Contracts\BasicApiOperations;
use App\Models\ProductCategory;

class ProductCategoryRepository implements BasicApiOperations
{
    /**
     * Get all `product_categories` data
     *
     * @param int $skip
     * @param int $limit
     * @return Illuminate\Support\Collection
     */
    public function getAll(int $skip, int $limit)
    {
        return ProductCategory::take($limit)->skip($skip)->get();
    }

    /**
     * Store data into `product_categories` table
     *
     * @param array $data
     * @return \App\Models\ProductCategory
     */
    public function storeData(array $data)
    {
        return ProductCategory::create($data);
    }

    /**
     * Get single `product_categories` data by id
     *
     * @param int $id
     * @return \App\Models\ProductCategory|null
     */
    public function findById($id)
    {
        return ProductCategory::where('id', $id)->first();
    }

    /**
     * Update data in `product_categories` table
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateById(array $data, $id)
    {
        ProductCategory::where('id', $id)->update($data);

        return $data;
    }

    /**
     * Delete data from `product_categories` table
     *
     * @param int $product_category_id
     * @param App\Models\ProductCategory $model
     * @return int
     */
    public function deleteById($id)
    {
        ProductCategory::destroy($id);

        return $id;
    }

    /**
     * Count the records of the `product_categories` table
     *
     * @return int
     */
    public function totalRecords()
    {
        return ProductCategory::count();
    }
}