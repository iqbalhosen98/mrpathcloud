<?php

namespace Mrpath\Customer\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Customer\Models\Customer::class,
        \Mrpath\Customer\Models\CustomerAddress::class,
        \Mrpath\Customer\Models\CustomerGroup::class,
        \Mrpath\Customer\Models\Wishlist::class,
    ];
}