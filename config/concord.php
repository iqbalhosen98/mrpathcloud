<?php

return [

    'convention' => Mrpath\Core\CoreConvention::class,

    'modules' => [

        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */

        \Mrpath\Admin\Providers\ModuleServiceProvider::class,
        \Mrpath\Attribute\Providers\ModuleServiceProvider::class,
        \Mrpath\BookingProduct\Providers\ModuleServiceProvider::class,
        \Mrpath\CartRule\Providers\ModuleServiceProvider::class,
        \Mrpath\CatalogRule\Providers\ModuleServiceProvider::class,
        \Mrpath\Category\Providers\ModuleServiceProvider::class,
        \Mrpath\Checkout\Providers\ModuleServiceProvider::class,
        \Mrpath\Core\Providers\ModuleServiceProvider::class,
        \Mrpath\CMS\Providers\ModuleServiceProvider::class,
        \Mrpath\Customer\Providers\ModuleServiceProvider::class,
        \Mrpath\Inventory\Providers\ModuleServiceProvider::class,
        \Mrpath\Marketing\Providers\ModuleServiceProvider::class,
        \Mrpath\Payment\Providers\ModuleServiceProvider::class,
        \Mrpath\Paypal\Providers\ModuleServiceProvider::class,
        \Mrpath\Product\Providers\ModuleServiceProvider::class,
        \Mrpath\Rule\Providers\ModuleServiceProvider::class,
        \Mrpath\Sales\Providers\ModuleServiceProvider::class,
        \Mrpath\Shipping\Providers\ModuleServiceProvider::class,
        \Mrpath\Shop\Providers\ModuleServiceProvider::class,
        \Mrpath\SocialLogin\Providers\ModuleServiceProvider::class,
        \Mrpath\Tax\Providers\ModuleServiceProvider::class,
        \Mrpath\Theme\Providers\ModuleServiceProvider::class,
        \Mrpath\Ui\Providers\ModuleServiceProvider::class,
        \Mrpath\User\Providers\ModuleServiceProvider::class,
        \Mrpath\Velocity\Providers\ModuleServiceProvider::class,

    ],
];
