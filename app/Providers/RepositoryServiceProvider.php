<?php

namespace App\Providers;

use App\Models\{Product, ProductCategory, ProductVariant, User};
use App\Repositories\Product\{ProductInterface, ProductRepository};
use App\Repositories\ProductCategory\{ProductCategoryInterface, ProductCategoryRepository};
use App\Repositories\ProductVariant\{ProductVariantInterface, ProductVariantRepository};
use App\Repositories\User\{AuthInterface, AuthRepository};
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


        $this->app->bind(ProductVariantInterface::class, function($app) {
            return new ProductVariantRepository(
                $app->make(ProductVariant::class)
            );
        });

        // Auth
        $this->app->bind(AuthInterface::class, function($app) {
            return new AuthRepository(
                $app->make(User::class)
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
