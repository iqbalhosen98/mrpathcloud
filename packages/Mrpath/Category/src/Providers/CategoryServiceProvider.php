<?php

namespace Mrpath\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Mrpath\Category\Models\CategoryProxy;
use Mrpath\Category\Observers\CategoryObserver;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        CategoryProxy::observe(CategoryObserver::class);
    }
}