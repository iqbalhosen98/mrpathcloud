<?php

namespace Mrpath\SocialLogin\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\SocialLogin\Models\CustomerSocialAccount::class,
    ];
}