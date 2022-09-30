<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\IProductRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ICategoryRepository;
use App\Repositories\CategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // register product repository
        $this->app->bind(IProductRepository::class, ProductRepository::class);

        // register category repository
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
