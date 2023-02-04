<?php

namespace Mrpath\CatalogRule\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\CatalogRule\Models\CatalogRule::class,
        \Mrpath\CatalogRule\Models\CatalogRuleProduct::class,
        \Mrpath\CatalogRule\Models\CatalogRuleProductPrice::class
    ];
}