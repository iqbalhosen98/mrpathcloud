<?php

namespace Mrpath\Category\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Category\Models\Category::class,
        \Mrpath\Category\Models\CategoryTranslation::class,
    ];
}