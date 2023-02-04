<?php

namespace Mrpath\Checkout\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Checkout\Models\Cart::class,
        \Mrpath\Checkout\Models\CartAddress::class,
        \Mrpath\Checkout\Models\CartItem::class,
        \Mrpath\Checkout\Models\CartPayment::class,
        \Mrpath\Checkout\Models\CartShippingRate::class,
    ];
}