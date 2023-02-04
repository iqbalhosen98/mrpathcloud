<?php

namespace Mrpath\Inventory\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Inventory\Models\InventorySource::class,
    ];
}