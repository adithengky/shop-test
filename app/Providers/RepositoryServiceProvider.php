<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\BaseRepoInterface; 
use App\Repository\BaseRepository; 
use App\Repository\User\UserRepository; 
use App\Repository\User\UserRepoInterface;
use App\Repository\Product\ProductRepoInterface; 
use App\Repository\Product\ProductRepository;
use App\Repository\Order\OrderRepository; 
use App\Repository\Order\OrderRepoInterface; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepoInterface::class, BaseRepository::class);
        $this->app->bind(ProductRepoInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepoInterface::class, OrderRepository::class);
        $this->app->bind(UserRepoInterface::class, UserRepository::class);
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
