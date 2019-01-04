<?php

namespace CodePub\Providers;

use CodeEduStore\Repositories\CategoryRepository;
use CodePub\Repositories\CategoryStoreRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryStoreRepositoryEloquent::class);
        //:end-bindings:
    }
}
