<?php

namespace Mrpath\Notification\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Mrpath\Notification\Models\Notification::class
    ];
}