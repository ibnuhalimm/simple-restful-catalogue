<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductCategory\ProductCategoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductCategoryInterface::class, function($app) {
            return new ProductCategoryRepository(
                $app->make(ProductCategory::class)
            );
        });

        // $this->app->bind(ProductCategoryService::class, function($app) {
        //     return new ProductCategoryService(
        //         $app->make(ProductCategoryInterface::class)
        //     );
        // });

        $this->app->bind(ProductInterface::class, function($app) {
            return new ProductRepository(
                $app->make(Product::class)
            );
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
