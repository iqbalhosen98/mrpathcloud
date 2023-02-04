<?php

namespace Mrpath\Product\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'catalog.attribute.create.after' => [
            'Mrpath\Product\Listeners\ProductFlat@afterAttributeCreatedUpdated'
        ],
        'catalog.attribute.update.after' => [
            'Mrpath\Product\Listeners\ProductFlat@afterAttributeCreatedUpdated'
        ],
        'catalog.attribute.delete.before' => [
            'Mrpath\Product\Listeners\ProductFlat@afterAttributeDeleted'
        ],
        'catalog.product.create.after' => [
            'Mrpath\Product\Listeners\ProductFlat@afterProductCreatedUpdated'
        ],
        'catalog.product.update.after' => [
            'Mrpath\Product\Listeners\ProductFlat@afterProductCreatedUpdated'
        ],
    ];
}
