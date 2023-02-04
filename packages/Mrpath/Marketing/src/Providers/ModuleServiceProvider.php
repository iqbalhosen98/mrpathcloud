<?php

namespace Mrpath\Marketing\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Marketing\Models\Campaign::class,
        \Mrpath\Marketing\Models\Template::class,
        \Mrpath\Marketing\Models\Event::class,
    ];
}