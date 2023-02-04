<?php

namespace Mrpath\User\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\User\Models\Admin::class,
        \Mrpath\User\Models\Role::class,
    ];
}