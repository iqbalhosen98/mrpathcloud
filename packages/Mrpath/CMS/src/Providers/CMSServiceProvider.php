<?php

namespace Mrpath\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Mrpath\CMS\Providers\ModuleServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}