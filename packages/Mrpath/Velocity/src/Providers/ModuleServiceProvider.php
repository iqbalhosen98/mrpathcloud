<?php

namespace Mrpath\Velocity\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Velocity\Models\Category::class,
        \Mrpath\Velocity\Models\Content::class,
        \Mrpath\Velocity\Models\ContentTranslation::class,
        \Mrpath\Velocity\Models\OrderBrand::class,
        \Mrpath\Velocity\Models\VelocityCustomerCompareProduct::class,
        \Mrpath\Velocity\Models\VelocityMetadata::class,
    ];
}