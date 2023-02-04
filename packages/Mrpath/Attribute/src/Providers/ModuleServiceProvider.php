<?php

namespace Mrpath\Attribute\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Attribute\Models\Attribute::class,
        \Mrpath\Attribute\Models\AttributeFamily::class,
        \Mrpath\Attribute\Models\AttributeGroup::class,
        \Mrpath\Attribute\Models\AttributeOption::class,
        \Mrpath\Attribute\Models\AttributeOptionTranslation::class,
        \Mrpath\Attribute\Models\AttributeTranslation::class,
    ];
}