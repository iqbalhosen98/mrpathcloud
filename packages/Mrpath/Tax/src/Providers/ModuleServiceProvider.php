<?php

namespace Mrpath\Tax\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Tax\Models\TaxCategory::class,
        \Mrpath\Tax\Models\TaxMap::class,
        \Mrpath\Tax\Models\TaxRate::class,
    ];
}