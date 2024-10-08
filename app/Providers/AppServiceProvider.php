<?php

namespace App\Providers;

use App\Repositories\Repository\CategoryRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Repository\ProductRepository;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{

    //Thay register
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();
    }
}
