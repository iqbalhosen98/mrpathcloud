<?php

namespace Mrpath\CartRule\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\CartRule\Models\CartRule::class,
        \Mrpath\CartRule\Models\CartRuleTranslation::class,
        \Mrpath\CartRule\Models\CartRuleCustomer::class,
        \Mrpath\CartRule\Models\CartRuleCoupon::class,
        \Mrpath\CartRule\Models\CartRuleCouponUsage::class
    ];
}